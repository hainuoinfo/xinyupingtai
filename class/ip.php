<?php
define('IPDat',d('./data/wry.Dat'));
class ip{
    private static $StartIp = 0,$EndIp=0,$Country = '',$Local   ='',$CountryFlag = 0,$fp,$FirstStartIp = 0,$LastStartIp = 0,$EndIpOff = 0 ;
    static function getStartIp ( $RecNo ) {
        $offset = self::$FirstStartIp + $RecNo * 7 ;
        @fseek (self::$fp , $offset , SEEK_SET ) ;
        $buf = fread (self::$fp , 7 ) ;
        self::$EndIpOff = ord($buf[4]) + (ord($buf[5])*256) + (ord($buf[6])* 256*256);
        self::$StartIp = ord($buf[0]) + (ord($buf[1])*256) + (ord($buf[2])*256*256) + (ord($buf[3])*256*256*256);
        return self::$StartIp;
    }
    static function getEndIp (){
        @fseek (self::$fp ,self::$EndIpOff , SEEK_SET ) ;
        $buf = fread(self::$fp , 5 ) ;
        self::$EndIp = ord($buf[0]) + (ord($buf[1])*256) + (ord($buf[2])*256*256) + (ord($buf[3])*256*256*256);
        self::$CountryFlag = ord ( $buf[4] ) ;
        return self::$EndIp ;
    }
    static function getCountry() {
        switch(self::$CountryFlag){
            case 1:
            case 2:
                self::$Country = self::getFlagStr(self::$EndIpOff+4);
                //echo sprintf('EndIpOffset=(%x)',$this->EndIpOff );
                self::$Local = ( 1 == self::$CountryFlag )? '' : self::getFlagStr(self::$EndIpOff+8);
                break ;
            default :
                self::$Country = self::getFlagStr(self::$EndIpOff+4) ;
                self::$Local = self::getFlagStr(ftell(self::$fp)) ;
        }
		self::$Country&&self::$Country=iconv('GBK',ENCODING,self::$Country);
		self::$Local&&self::$Local=iconv('GBK',ENCODING,self::$Local);
    }
    static function getFlagStr ( $offset ){
        $flag = 0 ;
        while ( 1 ){
            @fseek (self::$fp , $offset , SEEK_SET ) ;
            $flag =ord(fgetc(self::$fp ) ) ;
            if ($flag == 1 || $flag == 2 ) {
                $buf = fread (self::$fp , 3 ) ;
                if ($flag == 2 ){
                    self::$CountryFlag = 2 ;
                    self::$EndIpOff = $offset - 4 ;
                }
                $offset = ord($buf[0]) + (ord($buf[1])*256) + (ord($buf[2])* 256*256);
            }else{
                break ;
            }
        }
        if ( $offset < 12 )
            return '';
        @fseek(self::$fp , $offset , SEEK_SET ) ;
        return self::getStr();
    }
    static function getStr ( ){
        $str = '' ;
        while ( 1 ) {
            $c = fgetc (self::$fp);
            if (ord($c[0]) == 0  )
               break ;
            $str .= $c ;
        }
        return $str ;
    }
    static function qqwry ($dotip,$isint=false) {
        $nRet;
		$ip=$dotip;
        !$isint&&$ip = common::ipint($dotip);
        self::$fp= @fopen(IPDat, "rb");
        if (self::$fp == NULL) {
              $szLocal= "OpenFileError";
           return 1;
        }
        @fseek ( self::$fp , 0 , SEEK_SET ) ;
        $buf = fread ( self::$fp , 8 ) ;
        self::$FirstStartIp = ord($buf[0]) + (ord($buf[1])*256) + (ord($buf[2])*256*256) + (ord($buf[3])*256*256*256);
        self::$LastStartIp  = ord($buf[4]) + (ord($buf[5])*256) + (ord($buf[6])*256*256) + (ord($buf[7])*256*256*256);
        $RecordCount= floor( ( self::$LastStartIp - self::$FirstStartIp ) / 7);
        if ($RecordCount <= 1){
            $this->Country = "FileDataError";
            fclose (self::$fp);
            return 2 ;
        }
        $RangB= 0;
        $RangE= $RecordCount;
        // Match ...
        while($RangB < $RangE-1){
          $RecNo= floor(($RangB + $RangE) / 2);
          self::getStartIp ($RecNo);
            if ( $ip == self::$StartIp ){
                $RangB = $RecNo ;
                break ;
            }
          if ( $ip >self::$StartIp)
            $RangB= $RecNo;
          else
            $RangE= $RecNo;
        }
        self::getStartIp($RangB);
        self::getEndIp();
        if ((self::$StartIp<= $ip ) && (self::$EndIp >= $ip ) ){
            $nRet = 0 ;
            self::getCountry();
            self::$Local = str_replace("（我们一定要解放台湾！！！）", "",self::$Local);
        }else {
            $nRet = 3 ;
            self::$Country = '未知' ;
            self::$Local = '' ;
        }
        fclose (self::$fp);
        return $nRet ;
    }
	static function info($ip, $isint = false){
		$nRet = self::qqwry($ip,$isint);
		return array('coutry'=>self::$Country,'local'=>self::$Local);
	}
	static function address($ip,$isint=false){
		$nRet = self::qqwry($ip,$isint);
		return self::$Country.self::$Local;
	}
	public static function address2($ip,$t='{country}{local}'){
		$nRet = self::qqwry($ip,$isint);
		$t=str_replace('{country}',self::$Country,$t);
		$t=str_replace('{local}',self::$Local,$t);
		return $t;
	}
}
?>