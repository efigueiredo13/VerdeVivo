#include <WiFi.h>
#include <HTTPClient.h>
#include <LiquidCrystal_I2C.h> // Inclua a biblioteca para o display LCD

const char* ssid = "Weslley S";
const char* password = "97120Wes";
const char* server = "api.thingspeak.com";
const String apiKey = "W030R0LZO5GEVOQM";
const int sensorPin = 33; // Pino do sensor de umidade do solo

// Substitua 0x27 pelo endereço I2C encontrado pelo scanner
LiquidCrystal_I2C lcd(0x27, 16, 2);

unsigned long previousMillis = 0; // Armazena o último tempo de envio dos dados
const long interval = 10000; // Intervalo para envio de dados (10 segundos)

bool wifiConnected = false;

// Parâmetros para a média móvel
const int numReadings = 10;
int readings[numReadings]; // A leitura dos pinos analógicos
int readIndex = 0;         // O índice da leitura atual
int total = 0;             // A soma total
int average = 0;           // A média

void setup() {
  Serial.begin(115200);
  delay(40);

  Serial.println("Conectando ao WiFi...");
  WiFi.begin(ssid, password);
  while (WiFi.status() != WL_CONNECTED) {
    delay(20);
    Serial.print(".");
  }
  Serial.println("WiFi conectado");
  
  // Inicialize o display LCD
  lcd.init();
  lcd.backlight();
  
  // Inicialize o array de leituras
  for (int thisReading = 0; thisReading < numReadings; thisReading++) {
    readings[thisReading] = 0;
  }
}

void loop() {
  if (!wifiConnected || !isInternetConnected()) {
    Serial.println("Conexão perdida ou sem Internet! Tentando reconectar...");
    lcd.clear();
    lcd.setCursor(0, 0);
    lcd.print("Sem conexão");
    lcd.setCursor(0, 1);
    lcd.print("ou Internet!");
    
    // Tenta reconectar ao WiFi
    WiFi.begin(ssid, password);
    int attempt = 0;
    while (WiFi.status() != WL_CONNECTED && attempt < 10) {
      delay(500);
      Serial.print(".");
      attempt++;
    }
    if (WiFi.status() == WL_CONNECTED && isInternetConnected()) {
      Serial.println("\nConexão e Internet restauradas!");
      wifiConnected = true;
      lcd.clear();
      lcd.setCursor(0, 0);
      lcd.print("Conexão e");
      lcd.setCursor(0, 1);
      lcd.print("Internet OK!");
      delay(2000);
    } else {
      Serial.println("\nFalha na reconexão ao WiFi ou na obtenção de Internet!");
      wifiConnected = false;
    }
  }
  // Subtraia a última leitura
  total = total - readings[readIndex];
  // Leia o valor do sensor de umidade do solo
  readings[readIndex] = analogRead(sensorPin);
  // Adicione a leitura ao total
  total = total + readings[readIndex];
  // Avance para a próxima posição do array
  readIndex = readIndex + 1;

  // Se alcançamos o final do array, volte para o início
  if (readIndex >= numReadings) {
    readIndex = 0;
  }

  // Calcule a média
  average = total / numReadings;

  // Mapeie os valores do sensor para uma faixa de 0 a 100%
  int nivelUmidade = map(average, 4095, 0, 0, 100);
  nivelUmidade = constrain(nivelUmidade, 0, 100); // Garante que o valor está entre 0 e 100

  Serial.print("Nível de umidade: ");
  Serial.println(nivelUmidade);

  // Exiba o nível de umidade no display LCD
  lcd.clear();
  lcd.setCursor(0, 0);
  lcd.print("Nivel de umidade:");
  lcd.setCursor(0, 1);

  // Exiba um emoji correspondente ao nível de umidade
  if (nivelUmidade <= 20) {
    lcd.print("Baixa"); // Cacto para nível de umidade muito baixo
  } else if (nivelUmidade <= 40) {
    lcd.print("Moderada"); // Planta brotando para umidade baixa
  } else if (nivelUmidade <= 60) {
    lcd.print("Perfeito"); // Planta crescente para umidade moderada
  } else if (nivelUmidade <= 80) {
    lcd.print("Muito Alta"); // Árvore para umidade alta
  } 

  // Exiba a porcentagem de umidade
  lcd.print(" ");
  lcd.print(nivelUmidade);
  lcd.print("%");

  // Verifique se é hora de enviar os dados para o servidor
  unsigned long currentMillis = millis();
  if (currentMillis - previousMillis >= interval) {
    previousMillis = currentMillis;
    sendSensorData(nivelUmidade);
  }

  delay(1000); // Leia os dados do sensor a cada segundo
}

bool isInternetConnected() {
  WiFiClient client;
  if (!client.connect("api.thingspeak.com", 80)) {
    return false;
  }
  return true;
}

void sendSensorData(int nivelUmidade) {
  // Cria uma instância do cliente HTTP
  HTTPClient http;

  Serial.print("Conectando a ");
  Serial.println(server);

  // Monta a URL de requisição
  String url = "http://api.thingspeak.com/update?api_key=" + apiKey + "&field1=" + String(nivelUmidade);

  Serial.print("Requisição: ");
  Serial.println(url);

  // Envie a requisição HTTP GET
  http.begin(url);
  int httpCode = http.GET();

  if (httpCode > 0) {
    String payload = http.getString();
    Serial.println(payload);
  } else {
    Serial.println("Falha na requisição HTTP");
  }
  // Encerra a conexão
  http.end();
}