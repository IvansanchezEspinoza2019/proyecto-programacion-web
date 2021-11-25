void connect_webhost()
{
  //we have changing variable here, so we need to first build up our URL packet  
  /////////////////////////////////////////////////////////////////////////////
  url = "/id17924027_iotdb/RX.php?id=";
  url += unit_id;
  url += "&pw=";
  url +=  id_password;//sensor value
  url += "&s1=";
  url +=  String(sensor_value);//sensor value
  ///////////////////////////////////////////////////////////////////////////// 

  /////////////////////////////////////////////////////////////////////////////
  //Now that we have the "url" we insert it in the GET line
  URL_withPacket = ""; 
  URL_withPacket = (String("GET ") + url + " HTTP/1.1\r\n" +
                    "Host: " + host + "\r\n" + 
                    "Connection: close\r\n\r\n");
  /////////////////////////////////////////////////////////////////////////////
  
  ///This builds out the payload URL - not really needed here, but is very handy when adding different arrays to the payload
  counter=0;//keeps track of the payload size
  payload_size=0;
  for(int i=0; i<(URL_withPacket.length()); i++){//using a string this time, so use .length()
    payload[payload_size+i] = URL_withPacket[i];//build up the payload
    counter++;//increment the counter
  }//for int
  payload_size = counter+payload_size;
  //payload size is just the counter value - more on this when we need to build out the payload with more data
  
  if(connect_ESP()){}//connect ESP
  

}//connect web host
