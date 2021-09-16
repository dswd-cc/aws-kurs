# Aufgabe 4: Bewertungsfunktion mit DynamoDB


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

In EC2: Instanz starten
- Entweder mit Startvorlage von Aufgabe 3 oder manuell wie in Aufgabe 2
- IAM Rolle "aws-kurs-backend" der Instanz zuweisen (Rechtsklick auf Instanz, Security)


## 4) Code updaten

In Cloud9:
- Verzeichnis efs neu einbinden (wie in Aufgabe 2)
- Code von Aufgbe 4 aus Verzeichnis `code` nach efs rüberkopieren
- Evtl. auf Instanz einloggen und Berechtigungen vom Pictures-Verzeichnis neu setzen (wie in Aufgabe 2)

Im Browser:
- Backend über http://IP aufrufen
- Bilder hochladen und bewerten
- Seite neu laden um zu testen, dass die Bewertungen dauerhaft gespeichert sind