/* Tutorial: https://electronoobs.com/eng_arduino_tut114.php
 * Schematic: https://electronoobs.com/eng_arduino_tut114_sch1.php
 * PHP files: https://electronoobs.com/eng_arduino_tut114_code1.php
 * Code: https://electronoobs.com/eng_arduino_tut114_code3.php 
 * Video: https://www.youtube.com/watch?v=QabYZiSKHC8 */ 

#include <SoftwareSerial.h>
//#define _SS_MAX_RX_BUFF 256 
#define ESP8266_rxPin 6
#define ESP8266_txPin 7
#include <avr/power.h>

//////////////////////////CHANGE VALUES HERE//////////////////////////////
//SSID + KEY
const char SSID_ESP[] = "wifi";   //Your WiFI name
const char SSID_KEY[] = "HolamundoP7";       //WiFi passowrd
const char* host = "000webhostapp.com";    //Your domain without the "www"
String ESP8266_CONNECT = "AT+CIPSTART=0,\"TCP\",\"www.000webhostapp.com\",80\r\n"; //Your domain with the "www" this time
String unit_id = "1";                     //The id you've placed on the table you've created on the database
String id_password = "12345";             //The password for that id
String url = "";
//////////////////////////////////////////////////////////////////////////

//MODES
const char CWMODE = '1';//CWMODE 1=STATION, 2=APMODE, 3=BOTH
const char CIPMUX = '1';//CWMODE 0=Single Connection, 1=Multiple Connections
SoftwareSerial ESP8266(ESP8266_rxPin, ESP8266_txPin);// rx tx

//DEFINE ALL FUNCTIONS HERE
boolean setup_ESP();
boolean read_until_ESP(const char keyword1[], int key_size, int timeout_val, byte mode);
void timeout_start();
boolean timeout_check(int timeout_ms);
void serial_dump_ESP();
boolean connect_ESP();
void connect_webhost();


int sensor_value = 0;


unsigned long timeout_start_val;
char scratch_data_from_ESP[20];//first byte is the length of bytes
char payload[200];
byte payload_size=0, counter=0;
char ip_address[16];
String URL_withPacket = "";    
String payload_closer = " HTTP/1.1\r\n\r\n";
unsigned long multiplier[] = {1,10,100,1000,10000,100000,1000000,10000000,100000000,1000000000};

//DEFINE KEYWORDS HERE
const char keyword_OK[] = "OK";
const char keyword_Ready[] = "Ready";
const char keyword_no_change[] = "no change";
const char keyword_blank[] = "#&";
const char keyword_ip[] = "192.";
const char keyword_rn[] = "\r\n";
const char keyword_quote[] = "\"";
const char keyword_carrot[] = ">";
const char keyword_sendok[] = "SEND OK";
const char keyword_linkdisc[] = "Unlink";
const char keyword_doublehash[] = "##";


///////////////////////////////////SETUP///////////////////////////////////////
void setup(){
  //Pin Modes for ESP TX/RX
  pinMode(ESP8266_rxPin, INPUT);
  pinMode(ESP8266_txPin, OUTPUT); 
  pinMode(13, OUTPUT);  
  digitalWrite(13,LOW); 
  ESP8266.begin(9600);    //Default baudrate for ESP, maybe you have one with 115200
  ESP8266.listen();       //Not needed unless using other software serial instances
  Serial.begin(9600);     //For status and debug  
  delay(2000);            //delay before kicking things off
  setup_ESP();//go setup the ESP 
 
}//SETUP END
///////////////////////////////////SETUP///////////////////////////////////////



void loop(){//         LOOP     START
  
  sensor_value = analogRead(0);       //Read the sendor value connected on A0 
  connect_webhost();  
  delay(2500);//2.5 seconds between tries
  

}//VOID LOOP END
