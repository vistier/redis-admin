<?php

	class Database extends Redis {						
		
		function __construct(){
			$this->connect();
		}
		
		function setDefaultSchema($get){
		 	global $_SESSION;		 	
		 	if(!isset($_SESSION['REDIS']['DATABASE'])){
				$_SESSION['REDIS']['DATABASE']=15;
			}else{
			 	if(isset($get['db'])){
				 	$_SESSION['REDIS']['DATABASE']=$get['db'];
			 	}
			}
			$this->select_db(15);
			if(!$this->exists('schema:sid:15')){ 
			 	$this->set('schema:sid:15', 'info_schema');	
			}			
		}
		
		function setNewSchema($post){
			global $_SESSION;
		 	$this->select_db(15); 
		 	$post['schema'] = $this->getSlug($post['schema']);
		 	$return = $this->getKeys('schema:sid:*');
		 	if($return['count'] < 16){ 
		 	 	/* verify available id */
		 	 	for( $x=0; $x<$return['count']; $x++ ){
					if(!$this->exists('schema:sid:'.$x)){
					 	$keyid=$x; 
					 	break;
					}
					elseif(!$this->exists('schema:sid:'.($x+1))){
					 	$keyid=$x+1;
						break;			 	
					}
		 	 	}
				if(!$this->exists('schema:sid:'.$keyid)){ 		 	 	
			 	 	/* verify available schema name */
			 	 	for( $x=0; $x<$return['count']; $x++ ){		 	 	
			 	 		$schema_name = $this->get($return['keys'][$x]);
				 	 	if($schema_name == $post['schema']){ $keyname=true; break; }
					}
				}
				if(empty($keyname)){
					$this->set('schema:sid:'.$keyid, $post['schema']);
				} 
			}
		 	$this->select_db($keyid);
			$this->set('create_date', date('Y-m-d H:i:s'));			
		 	$this->select_db(15);			 	
		}
		
		function setDropSchema($dbid){
		 	$this->flushdb($dbid);
		 	$this->select_db(15); 
		 	return $this->delete('schema:sid:'.$dbid);		 	
		}
		
		function setIncr($key, $amount){
			return $this->incr($key, $amount);	
		}
			
		function setDecr($key, $amount){
			return $this->decr($key, $amount);	
		}
					
		function setMoveKey($key, $dbid){
		 	return $this->move($key, $dbid);		 	
		}		

		function setNewKey($post){
		 	$post['key']=$this->getSlug($post['key']);
		 	$post['value']=addslashes($post['value']);
		 	$post['score']=addslashes($post['score']);
		 	$post['member']=addslashes($post['member']);			 		 	
		 	if($post['type']=='string'){
		 	 	$this->set($post['key'],$post['value']);
		 	 	return "SET {$post['key']} '{$post['value']}'; OK;";
		 	}elseif($post['type']=='list'){
		 	 	$this->push($post['key'],$post['value']);
		 	 	return "LPUSH {$post['key']} '{$post['value']}'; OK;";				
			}elseif($post['type']=='set'){
		 	 	$this->sadd($post['key'], $post['value']);
		 	 	return "SADD {$post['key']} '{$post['value']}'; OK;";			 
			}elseif($post['type']=='zset'){
		 	 	$this->zadd($post['key'], $post['score'], $post['member']);
		 	 	return "ZADD {$post['key']} {$post['score']} \'{$post['member']}\'; OK;";			 			 
			}
		}
				
		function setCommand($cmd){
			$command = $this->command($cmd); 
			return $command;
		}
									
		function getSchemas(){
			global $_SESSION;
			$this->select_db(15);
			$keys = $this->getKeys('schema:sid:*'); 
			$this->select_db($_SESSION['REDIS']['DATABASE']);
			return $keys;
		}
	
		function getKeys($pattern){
		 	$res['keys'] 	= $this->keys($pattern);
		 	$res['count']	= count($res['keys']);
			ksort($res['keys']);
			return $res;
		}
		
		function getKeyValue($key, $offset=false, $limit=false){
		 	global $_SESSION;
			$this->select_db($_SESSION['REDIS']['DATABASE']);		 	
		 	$type = $this->type($key);
		 	if($type=='string'){
				$res = $this->get($key);
			 	$rows['keys'][] = $res;				
			}
		 	if($type=='list'){
			  	$res = $this->lrange($key, $offset, $limit);
			 	$rows['keys'] = $res;				  	
			}	
		 	if($type=='set'){
			  	$res = $this->smembers($key);
			 	$rows['keys'] = $res;				  				  	
			}
		 	if($type=='zset'){
			  	$res = $this->zrange($key, $offset, $limit);
			 	$rows['keys'] = $res;				  				  	
			}
		 	$rows['count'] = count($rows['keys']);
			return $rows;
		}
		
		function getSingleKeyValue($db, $key){	
			$this->select_db($db);		 	 
		 	$type = $this->type($key);
		 	if($type=='string') $res = $this->get($key);
		 	if($type=='list') $res = $this->llen($key);	
		 	if($type=='set') $res = $this->scard($key);
		 	if($type=='zset') $res = $this->zcard($key);
		 	return $res;
		}

		function getKeyExists($key){
			return $this->exists($key); 
		}
		
		function getType($key){
			return $this->type($key); 
		}		
		
		function getNumElements($key){
		 	$type = $this->type($key);
		 	if($type=='string') $res = '1';
		 	if($type=='list') $res = $this->llen($key);	
		 	if($type=='set') $res = $this->scard($key);
		 	if($type=='zset') $res = $this->zcard($key);		 	
			return $res;
		}
		
		function getSchemaKeys($pattern){
			global $_SESSION;
			if($pattern=='all'){
			 	$items = $this->getPatterns();
			}else{
			 	$items[0] = $pattern;
			}
			for($x=0; $x<count($items); $x++){
				$this->select_db($_SESSION['REDIS']['DATABASE']);
				if(count($items)>1){
					$pattern = $items[$x]."*";
				}else{
				 	$pattern = $items[0];
				}
				$rows = $this->getKeys($pattern); 
				for($xx=0; $xx<count($rows['keys']); $xx++){
				  	if(!empty($rows['keys'][$xx])){
						$keys['keys'][] = $rows['keys'][$xx];
						$numrows++;									
					}
					if($numrows==30) break;
				}
				if($numrows==30) break;
			}
			$keys['count'] = $numrows;
			return $keys;		 
		}
	
		function setDeleteKey($key){
		 	$res = $this->delete($key);
			return $res;
		}
			
		function getPatterns(){
		 	$numbers 	= array('0','1','2','3','4','5','6','7','8','9');
		 	$lowercase 	= array('a','b','c','d','e','f','g','h','i','j','k','l',
			 					'm','n','o','p','q','r','s','t','u','v','w','x','y','z');		 	
		 	$uppercase 	= array('A','B','C','D','E','F','G','H','I','J','K','L',
			 					'M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');		 			 	
		 	$chars 		= array('-','_',':');			 					
		 	return array_merge($numbers, $lowercase, $uppercase, $chars);
		}
		
		function getMonitor(){
			$res = $this->get();
			return $res;
		}
				
		function Request($method){
		 	if($method=='get'){
				global $_GET;
				$get = $_GET;
				return $get; 
			}elseif($method=='post'){
				global $_POST;
				$post = $_POST;
				return $post; 
			}
		}		
		
		function getSlug($str){
	    	$str = trim($str);
	      	$str = preg_replace('/[^A-Za-z0-9-:_]/', '', $str);
	      	$str = preg_replace('/-+/', "-", $str);
	      	return $str;
      	}
		  		
	}