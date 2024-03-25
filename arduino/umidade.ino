#include <LiquidCrystal.h>
#define sensorPIN A0
#define NUM_SAMPLES 10 // Número de amostras para média móvel
int sensorValues[NUM_SAMPLES];
int currentIndex = 0;
LiquidCrystal lcd(12, 11, 5, 4, 3, 2);
void setup() {
 Serial.begin(9600);
 delay(1000);
 lcd.begin(16, 2);
}

void loop() {
 // Ler o sensor e calcular a média móvel
 int total = 0;
 for (int i = 0; i < NUM_SAMPLES; i++) {
 sensorValues[i] = analogRead(sensorPIN);
 total += sensorValues[i];
 delay(10); // Pequeno atraso entre as leituras
 }
 int averageValue = total / NUM_SAMPLES;
 lcd.clear();
 if (averageValue < 400) {
 lcd.setCursor(2, 0);
 lcd.print("Solo umido");
 } else if (averageValue < 800) {
 lcd.setCursor(1, 0);
 lcd.print("Solo quase seco");
 } else {
 lcd.setCursor(3, 0);
 lcd.print("Solo seco");
 }
 lcd.setCursor(0, 1);
 lcd.print("va : ");
 lcd.print(averageValue);
 
 delay(2000);
}
