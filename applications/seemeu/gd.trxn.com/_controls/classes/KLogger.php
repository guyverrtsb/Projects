<?php
	
	/* Finally, A light, permissions-checking logging class. 
	 * 
	 * Author	: Kenneth Katzgrau < katzgrau@gmail.com >
	 * Date	: July 26, 2008
	 * Comments	: Originally written for use with wpSearch
	 * Website	: http://codefury.net
	 * Version	: 1.0
	 *
	 * Usage: 
	 *		$log = new KLogger ( "log.txt" , KLogger::INFO );
	 *		$log->LogInfo("Returned a million search results");	//Prints to the log file
	 *		$log->LogFATAL("Oh dear.");				//Prints to the log file
	 *		$log->LogDebug("x = 5");					//Prints nothing due to priority setting
	*/
	
	class KLogger
	{
		
		const DEBUG 	= 1;	// Most Verbose
		const INFO 		= 2;	// ...
		const WARN 		= 3;	// ...
		const ERROR 	= 4;	// ...
		const FATAL 	= 5;	// Least Verbose
		const OFF 		= 6;	// Nothing at all.
		
		const LOG_OPEN 		= 1;
		const OPEN_FAILED 	= 2;
		const LOG_CLOSED 	= 3;
		
		/* Public members: Not so much of an example of encapsulation, but that's okay. */
		public $Log_Status 	= KLogger::LOG_CLOSED;
		public $DateFormat	= "Y-m-d G:i:s";
		public $MessageQueue;
	
		private $log_file;
		private $priority = KLogger::INFO;
		
		private $file_handle;
		
		public function __construct($loglevel)
		{
            $filepath = "../../ZLOG.txt";
		    if(isset($_SESSION[AppSysIntegration::getKeySessSiteConfigRoot()]))
            {
                $filepath = $_SESSION[AppSysIntegration::getKeySessSiteConfigRoot()]."ZLOG.txt";
            }
            
            $DEBUG     = 1;    // Most Verbose
            $INFO      = 2;    // ...
            $WARN      = 3;    // ...
            $ERROR     = 4;    // ...
            $FATAL     = 5;    // Least Verbose
            $OFF       = 6;    // Nothing at all.

		    $priority = $loglevel;
            
			if ( $priority == KLogger::OFF ) return;
			
			$this->log_file = $filepath;
			$this->MessageQueue = array();
			$this->priority = $priority;
			
			if ( file_exists( $this->log_file ) )
			{
				if ( !is_writable($this->log_file) )
				{
					$this->Log_Status = KLogger::OPEN_FAILED;
					$this->MessageQueue[] = "The file exists, but could not be opened for writing. Check that appropriate permissions have been set.";
					return;
				}
			}
			
			if ( $this->file_handle = fopen( $this->log_file , "a" ) )
			{
				$this->Log_Status = KLogger::LOG_OPEN;
				$this->MessageQueue[] = "The log file was opened successfully.";
			}
			else
			{
				$this->Log_Status = KLogger::OPEN_FAILED;
				$this->MessageQueue[] = "The file could not be opened. Check permissions.";
			}
			
			return;
		}
		
		public function __destruct()
		{
			if ( $this->file_handle )
				fclose( $this->file_handle );
		}
        
        /** ************************************************ **/
        /** START CUSTOM LOG FUNCTIONS
        /** ************************************************ **/
        public function LogPageDeclaration()
        {
            $includedFiles = get_included_files();
            $this->Log("PAGE_NAME-[".$includedFiles[0]."]", KLogger::INFO );
        }
        public function LogAllPageDeclaration()
        {
            $includedFiles = get_included_files();
            foreach($includedFiles as $filename)
            $this->Log("PAGE_NAME-[".$filename."]", KLogger::INFO );
        }
        
        public function LogDBResult($result)
        {
            $this->Log("DB_RESULT-[".json_encode($result)."]", KLogger::INFO );
        }
        
        public function LogReturn($line)
        {
            $this->Log("RETURN-[".$line."]", KLogger::INFO );
            return $line;
        }
        
        public function LogTaskLabel($line)
        {
            $this->Log(":-----------------------[".$line."]", KLogger::INFO );
            return $line;
        }
        
        public function LogIssue($line)
        {
            $this->Log("############################################################################################################", KLogger::INFO );
            $this->Log("ISSUE-[".$line."]", KLogger::INFO );
            $this->Log("############################################################################################################", KLogger::INFO );
            return $line;
        }


        public function Log_ReturnItem($line)
        {
            $this->Log("RETURN_ITEM-".$line, KLogger::INFO );
        }
        
        public function LogStart_ExecutorFunction($methodname)
        {
            if(strtoupper($methodname) != "SAVEACTIVITYLOG")
                $this->Log("-\/--\/--\/--\/--\/--\/--\/--\/--\/--\/--\/--\/--\/--\/--\/--\/--\/--\/--\/--\/--\/--\/--\/--\/--\/--\/-", KLogger::INFO );
            $this->Log("START:EXECUTOR:[".$methodname."]", KLogger::INFO );
        }
        public function LogEnd_ExecutorFunction($methodname)
        {
            $this->Log("END  :EXECUTOR:[".$methodname."]", KLogger::INFO );
            if(strtoupper($methodname) != "SAVEACTIVITYLOG")
                $this->Log("-/\--/\--/\--/\--/\--/\--/\--/\--/\--/\--/\--/\--/\--/\--/\--/\--/\--/\--/\--/\--/\--/\--/\--/\--/\--/\-", KLogger::INFO );
        }
        
        public function LogStart_AccessPointFunction($methodname)
        {
            if(strtoupper($methodname) != "SAVEACTIVITYLOG")
                $this->Log("-\/--\/--\/--\/--\/--\/--\/--\/--\/--\/--\/--\/--\/--\/--\/--\/--\/--\/--\/--\/--\/--\/--\/--\/--\/--\/-", KLogger::INFO );
            $this->Log("START:ACCESSPOINT:[".$methodname."]", KLogger::INFO );
        }
        public function LogEnd_AccessPointFunction($methodname)
        {
            $this->Log("END  :ACCESSPOINT:[".$methodname."]", KLogger::INFO );
            if(strtoupper($methodname) != "SAVEACTIVITYLOG")
                $this->Log("-/\--/\--/\--/\--/\--/\--/\--/\--/\--/\--/\--/\--/\--/\--/\--/\--/\--/\--/\--/\--/\--/\--/\--/\--/\--/\-", KLogger::INFO );
        }
        
        public function LogStart_DataObjectFunction($methodname)
        {
            if(strtoupper($methodname) != "SAVEACTIVITYLOG")
                $this->Log("-\/--\/--\/--\/--\/--\/--\/--\/--\/--\/--\/--\/--\/--\/--\/--\/--\/--\/--\/--\/--\/--\/--\/--\/--\/--\/-", KLogger::INFO );
            $this->Log("START:DATAOBJECT:[".$methodname."]", KLogger::INFO );
        }
        public function LogEnd_DataObjectFunction($methodname)
        {
            $this->Log("END  :DATAOBJECT:[".$methodname."]", KLogger::INFO );
            if(strtoupper($methodname) != "SAVEACTIVITYLOG")
                $this->Log("-/\--/\--/\--/\--/\--/\--/\--/\--/\--/\--/\--/\--/\--/\--/\--/\--/\--/\--/\--/\--/\--/\--/\--/\--/\--/\-", KLogger::INFO );
        }
        
        public function LogStart_Function($methodname)
        {
            if(strtoupper($methodname) != "SAVEACTIVITYLOG")
                $this->Log("-\/--\/--\/--\/--\/--\/--\/--\/--\/--\/--\/--\/--\/--\/--\/--\/--\/--\/--\/--\/--\/--\/--\/--\/--\/--\/-", KLogger::INFO );
            $this->Log("START:FUNCTION:[".$methodname."]", KLogger::INFO );
        }
        public function LogEnd_Function($methodname)
        {
            $this->Log("END  :FUNCTION:[".$methodname."]", KLogger::INFO );
            if(strtoupper($methodname) != "SAVEACTIVITYLOG")
                $this->Log("-/\--/\--/\--/\--/\--/\--/\--/\--/\--/\--/\--/\--/\--/\--/\--/\--/\--/\--/\--/\--/\--/\--/\--/\--/\--/\-", KLogger::INFO );
        }
        /** ************************************************ **/
        /** END CUSTOM LOG FUNCTIONS
        /** ************************************************ **/
		public function LogInfo($line)
		{
			$this->Log( $line , KLogger::INFO );
		}
		
		public function LogDebug($line)
		{
			$this->Log( $line , KLogger::DEBUG );
		}
		
		public function LogWarn($line)
		{
			$this->Log( $line , KLogger::WARN );	
		}
		
		public function LogError($line)
		{
			$this->Log( $line , KLogger::ERROR );		
		}

		public function LogFatal($line)
		{
			$this->Log( $line , KLogger::FATAL );
		}
		
		public function Log($line, $priority)
		{
			if ( $this->priority <= $priority )
			{
				$status = $this->getTimeLine( $priority );
				$this->WriteFreeFormLine ( "$status $line \n" );
			}
		}
		
		public function WriteFreeFormLine( $line )
		{
			if ( $this->Log_Status == KLogger::LOG_OPEN && $this->priority != KLogger::OFF )
			{
			    if (fwrite( $this->file_handle , $line ) === false) {
			        $this->MessageQueue[] = "The file could not be written to. Check that appropriate permissions have been set.";
			    }
			}
		}
		
		private function getTimeLine( $level )
		{
			$time =  date ( $this->DateFormat );
		
			switch( $level )
			{
				case KLogger::INFO:
					return "$time - INFO  -->";
				case KLogger::WARN:
					return "$time - WARN  -->";				
				case KLogger::DEBUG:
					return "$time - DEBUG -->";				
				case KLogger::ERROR:
					return "$time - ERROR -->";
				case KLogger::FATAL:
					return "$time - FATAL -->";
				default:
					return "$time - LOG   -->";
			}
		}
		
	}


?>