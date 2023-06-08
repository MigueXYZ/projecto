#include <WiFi101.h>
#include <ArduinoHttpClient.h>
#include <DHT.h>

#include <NTPClient.h>
#include <WiFiUdp.h>
#include <TimeLib.h>

#define DHTPIN 0 // Pin Digital onde estÃ¡ ligado o sensor
#define DHTTYPE DHT11
DHT dht(DHTPIN, DHTTYPE);

WiFiUDP client;
//IPLeiria: ntp.ipleiria.pt
char SERVER[] = "0.pool.ntp.org";
NTPClient clienteNTP(client, SERVER, 3600);

char SSID[] = ""; //SSID da rede a conectar
char PASS_WIFI[] = ""; //Passowrd da rede a conectar

//char URL[] = "iot.dei.estg.ipleiria.pt";
char URL[] = "10.79.12.20";
int PORTO = 80; // (Porto definido no servidor)

WiFiClient clientWifi;
HttpClient clientHTTP = HttpClient(clientWifi, URL, PORTO);

//define sensor de fogo
const int CancelaA_LED = 9;
const int CancelaA_MOTOR = 8;
const int CancelaB_LED = 6;
const int CancelaB_MOTOR = 7;
const int BotaoA_Pin=12;
const int BotaoB_Pin=13;

//hora do update efetuado, para colocar na dashboard
void update_time(char *datahora){
  clienteNTP.update();
  unsigned long epochTime = clienteNTP.getEpochTime();
  sprintf(datahora, "%02d-%02d-%02d %02d", year(epochTime), month(epochTime), day(epochTime), hour(epochTime));
}

void setup() {
  Serial.begin(115200);
  // inicia os pinos
  pinMode(CancelaA_LED, OUTPUT);
  pinMode(CancelaA_MOTOR, OUTPUT);
  pinMode(CancelaB_LED, OUTPUT);
  pinMode(CancelaB_MOTOR, OUTPUT);
  pinMode(BotaoA_Pin,INPUT);
  pinMode(BotaoB_Pin,INPUT);

  //conecta ao wifi
  while (!Serial){
    WiFi.begin(SSID, PASS_WIFI);

    while (WiFi.status() != WL_CONNECTED){
      Serial.print(".");
      delay(100);
    }

  Serial.print(" Connected! ");
  }
  dht.begin();
}


void loop() {
  //define variaveis que armazenam a temperatura, humidade e estado dos botões
  float temp = dht.readTemperature();
  float hum = dht.readHumidity();
  BotaoA_Estado=digitalRead(BotaoA_Pin);
  BotaoB_Estado=digitalRead(BotaoB_Pin);

    //atualiza a hora apos leitura
    char datahora[20];
    update_time(datahora);

  if(BotaoA_Estado == HIGH){
      digitalWrite(CancelaA_MOTOR,HIGH);
      digitalWrite(CancelaA_LED,HIGH);
      post2API("CancelaA","1",datahora);
      post2API("Veiculos","1",datahora);
      delay(5000);
  }else{
    digitalWrite(CancelaA_MOTOR,LOW);
    digitalWrite(CancelaA_LED,LOW);
    post2API("CancelaA","0",datahora);
  }

  if(BotaoB_Estado == HIGH){
        digitalWrite(CancelaB_MOTOR,HIGH);
        digitalWrite(CancelaB_LED,HIGH);
        post2API("CancelaB","1",datahora);
        post2API("Veiculos","0",datahora);
        delay(5000);
  }else{
    digitalWrite(CancelaB_MOTOR,LOW);
    digitalWrite(CancelaB_LED,LOW);
    post2API("CancelaB","0",datahora);
  }


    //envia para a api os valores
  post2API("Temperatura", String(temp) , datahora);
  post2API("Humidade", String(hum) , datahora);
  // added code
  delay(1000);
}

void post2API(String sendName, String sendValue, String sendTime){

  String URLPath = "/projeto/projecto/api/api.php";
  String contentType = "application/x-www-form-urlencoded";


  String body = "nome="+sendName+"&valor="+sendValue+"&hora="+sendTime;

  clientHTTP.post(URLPath, contentType, body);

  while(clientHTTP.connected()){
    if (clientHTTP.available()){
      int statusCodeResponse = clientHTTP.responseStatusCode();
      String bodyResponse = clientHTTP.responseBody();
      Serial.println("Status Code: "+String(statusCodeResponse)+" Response: "+bodyResponse);
    }
  }
}