#include <WiFi.h>
#include <Wire.h> 
#include <LiquidCrystal_I2C.h>

LiquidCrystal_I2C lcd(0x27,16,2);  // set the LCD address to 0x27 for a 16 chars and 2 line display


int motion1 = 15;     // 센서 신호핀
int motion2 = 26;
int mic1 = A0;
int led1 = 32;
int state = LOW;   // 센서 초기상태는 움직임이 없음을 가정
int val1 = 0;
int val2 = 0;
int val3 = 0;

const char* host = "10.150.149.164";
const int Port = 80;

const char* ssid = "bssm_free";
const char* password = "bssm_free";

WiFiClient client;

void setup() {
  Serial.begin(115200); //결과를 PC에서보겠다!

  lcd.init();
  lcd.backlight();
  
  WiFi.mode(WIFI_STA);
  WiFi.begin(ssid, password);
  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }
  Serial.println("");
  Serial.println("WiFi connected");
  Serial.println("IP address: ");
  Serial.println(WiFi.localIP()); 

  pinMode(motion1, INPUT);    // 모션센서 Input 설정
  pinMode(motion2, INPUT);    // 모션센서 Input 설정
  pinMode(mic1, INPUT);       // 마이크센서 Input 설정
  pinMode(led1, OUTPUT);

}

void loop() {
  //1.클라이언트가 서버에 접속한다
  if (!client.connect(host, Port)) {
    Serial.println("connection failed");
    return;
  }
  Serial.println("서버와 연결되었습니다!");
  //2.클라이언트가 서버에 request를 전송한다

  val1 = digitalRead(motion1); // 모션센서 -1 인식하기
  val2 = digitalRead(motion2); // 모션센서 -2 인식하기
  val3 = analogRead(mic1);     // 마이크 센서 인식하기

  if(val3 > 750){
    digitalWrite(32, 255);
  }else if(val3 > 730){
    digitalWrite(32, 5);}
  else{
    digitalWrite(32, 0);
  }

  
  if(val1==0 && val2 ==0){
    lcd.setCursor(0,0);
    lcd.print("All the rooms");
    lcd.setCursor(0,1);
    lcd.print("are empty");
  }else if(val1 == 0 && val2 == 1){
    lcd.setCursor(0,0);
    lcd.print("Room number one");
    lcd.setCursor(0,1);
    lcd.print("is empty.");
  }else if(val1 == 1 && val2 ==0) {
    lcd.setCursor(0,0);
    lcd.print("Room number two");
    lcd.setCursor(0,1);
    lcd.print("is empty.");
  }else{
    lcd.setCursor(0,0);
    lcd.print("All the rooms");
    lcd.setCursor(0,1);
    lcd.print("are full.");
    
  }
  

  
String url = "/pages/view2.php?seat1="+String(val1)+"&seat2="+String(val2)+"&mic="+String(val3);
  client.print(String("GET ") + url + " HTTP/1.1\r\n" +
               "Host: "+ host +"\r\n" +
               "Connection: close\r\n\r\n");


  //3.서버가 클라이언트에게 response를 전송한다
  unsigned long t = millis(); //생존시간
  Serial.println(url);
  while(1){
    if(client.available()) break;
    if(millis() - t > 10000) break;
  }

  while(client.available()) {
    Serial.write(client.read());
  }
  //응답이 왔거나 시간안에 응답이 안왔다!
  Serial.println("응답이 도착했습니다");
  
  //4.둘사이의 연결이 끊어진다!
  Serial.println("연결이 해제되었습니다!");
  delay(1000);
}