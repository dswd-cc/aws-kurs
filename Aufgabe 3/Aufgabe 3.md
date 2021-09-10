# Aufgabe 3: Bewertungsfunktion mit DynamoDB


## 1) Erstellen einer DynamoDB

DynamoDB -> Tabelle erstellen
- Tabellenname: aws-kurs-db
- Partitionsschlüssel: file
- "Einstellungen anpassen" -> "On demand" auswählen
- "Tabelle erstellen"


## 2) Erstellen einer Rolle mit Zugriff auf die Tabelle

In DynamoDB:
- Tabellen ARN aus den Infos kopieren

In IAM: Richtlinie erstellen (unter Richtlinien)
- Service: DynamoDB
- Aktionen: alle
- Ressourcen -> table: Kopierte ARN einfügen
- Weiter, keine Tags, Weiter
- Name: aws-kurs-db-access


In IAM: Rolle erstellen (unter Rollen)
- "EC2" unter "Häufige Anwendungsfälle" wählen
- Richtlinien: aws-kurs-db-access wählen
- Weiter, keine Tags, Weiter
- Name: aws-kurs-backend
- "Rolle erstellen"


## 3) Rolle verwenden