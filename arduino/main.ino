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
char SERVER[] = "10.79.12.254";
NTPClient clienteNTP(client, SERVER, 3600);

char SSID[] = "labs_lca"; //SSID da rede a conectar
char PASS_WIFI[] = "robot1cA!ESTG"; //Passowrd da rede a conectar

//char URL[] = "iot.dei.estg.ipleiria.pt";
char URL[] = "10.79.12.175";
int PORTO = 80; // (Porto definido no servidor)

WiFiClient clientWifi;
HttpClient clientHTTP = HttpClient(clientWifi, URL, PORTO);

//define
//const int CancelaA_LED = 9;
//const int CancelaA_MOTOR = 8;
//const int CancelaB_LED = 6;
//const int CancelaB_MOTOR = 7;
const int BotaoA_Pin=3;
const int BotaoB_Pin=4;
int BotaoA_Estado_B=0;
int BotaoB_Estado_B=0;

//hora do update efetuado, para colocar na dashboard
void update_time(char *datahora){
  clienteNTP.update();
  unsigned long epochTime = clienteNTP.getEpochTime();
  sprintf(datahora, "%02d-%02d-%02d %02d:%02d:%02d", year(epochTime), month(epochTime), day(epochTime), hour(epochTime),minute(epochTime),second(epochTime));
  Serial.println(datahora);

}

void setup() {
  Serial.begin(19200);
  // inicia os pinos
  //pinMode(CancelaA_LED, OUTPUT);
  //pinMode(CancelaA_MOTOR, OUTPUT);
  //pinMode(CancelaB_LED, OUTPUT);
  //pinMode(CancelaB_MOTOR, OUTPUT);
  pinMode(BotaoA_Pin,INPUT);
  pinMode(BotaoB_Pin,INPUT);
  //conecta ao wifi
  while (!Serial){
    WiFi.begin(SSID, PASS_WIFI);

    while (WiFi.status() != WL_CONNECTED){
      Serial.print(".");
      delay(100);
    }

  Serial.print(" Connected! \n");
  }
  dht.begin();
}


void loop() {
  //define variaveis que armazenam a temperatura, humidade e estado dos botões
  float temp = dht.readTemperature();
  float hum = dht.readHumidity();
  int BotaoA_Estado=digitalRead(BotaoA_Pin);
  int BotaoB_Estado=digitalRead(BotaoB_Pin);
  Serial.print("Boas\n");
    //atualiza a hora apos leitura
    char datahora[20];
    update_time(datahora);

  if(BotaoA_Estado!=BotaoA_Estado_B){
    if(BotaoA_Estado == HIGH){
      Serial.print("Movimento Botao A\n");
        //digitalWrite(CancelaA_MOTOR,HIGH);
        //digitalWrite(CancelaA_LED,HIGH);
        post2API("CancelaA","0",datahora);
        post2API("Veiculos","1",datahora);
    }else{
      Serial.print("Fim de Movimento Botao A\n");
      //digitalWrite(CancelaA_MOTOR,LOW);
      //digitalWrite(CancelaA_LED,LOW);
      post2API("CancelaA","1",datahora);
    }
    BotaoA_Estado_B=BotaoA_Estado;
  }
  if(BotaoB_Estado!=BotaoB_Estado_B){
    if(BotaoB_Estado == HIGH){
      Serial.print("Movimento Botao B\n");
          //digitalWrite(CancelaB_MOTOR,HIGH);
          //digitalWrite(CancelaB_LED,HIGH);
          post2API("CancelaB","0",datahora);
          post2API("Veiculos","0",datahora);
    }else{
      Serial.print("Fim Movimento Botao B\n");
      //digitalWrite(CancelaB_MOTOR,LOW);
      //digitalWrite(CancelaB_LED,LOW);
      post2API("CancelaB","1",datahora);
    }
    BotaoB_Estado_B=BotaoB_Estado;
  }
  Serial.print("Posting\n");

    //envia para a api os valores
  post2API("Temperatura", String(temp) , datahora);
  post2API("Humidade", String(hum) , datahora);
  // added code
  Serial.print("Sleeping\n");
  delay(1000);
}

void post2API(String sendName, String sendValue, String sendTime){

  String URLPath = "/projeto/api/api.php";
  String contentType = "application/x-www-form-urlencoded";
  Serial.print("Entrei no post\n");

  String body = "nome="+sendName+"&valor="+sendValue+"&hora="+sendTime;

  clientHTTP.post(URLPath, contentType, body);

  Serial.print("Enviei post\n");
  while(clientHTTP.connected()){
    if (clientHTTP.available()){
      int statusCodeResponse = clientHTTP.responseStatusCode();
      String bodyResponse = clientHTTP.responseBody();
      Serial.println("Status Code: "+String(statusCodeResponse)+" Response: "+bodyResponse);
    }
  }
}