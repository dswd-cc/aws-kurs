# Aufgabe 4: Auto-Scaling und Load-Balancing


## 1) Startvorlage erstellen

In EFS: Dateisystems-ID (fs-...) kopieren

In EC2: Starvorlage erstellen
- Name: aws-kurs-backend
- Anleitugen für Auto-Scaling aktivieren
- AMI: Amazon Linux 2 (SSD) x86 (!)
- Instanztyp: t2.micro
- Schlüsselpaar: aws-kurs
- Sicherheitsgruppen: aws-kurs-backend
- Benutzerdaten: [Daten aus userdata.txt, Dateisystems-ID (Zeile 9) ersetzen]


## 2) Auto-Scaling-Gruppe und Load-Balancer erstellen

In EC2: Auto-Scaling Gruppen -> Erstellen

Schritt 1:
- Name: aws-kurs-backends
- Startvorlage: aws-kurs-backend

Schritt 2:
- "Startvorlage beachten"
- Subnetze: Alle 3 auswählen

Schritt 3:
- Load-Balancer: neuer Loadbalancer
- Typ: Application Load Balancer
- Name: aws-kurs-backends
- Schema: Internet-Facing
- Weiterleitung: Neue Zielgruppe
- Name der Zielgruppe: aws-kurs-backends

Schritt 4:
- Maximale Kapazität: 2
- Skalierungsrichtlinie erstellen
- Richtlinie: CPU Auslastung 50%

Schritte 5 und 6: weiter

Gruppe erstellen


## 3) Loadbalancer testen

In EC2: Details vom Loadbalancer öffnen (unter Loadbalancer)
- Warten bis Zustand = "aktiv"
- URL vom Loadbalancer kopieren und im Browser aufrufen

In EC2: Private IP von Instanz kopieren
In Cloud9:
- Auf Instanz einloggen: `ssh -i aws-kurs.pem IP` (IP einfügen)
- `md5sum /dev/urandom` (Befehl bleibt aktiv)

In EC2: Unter "Auto Scaling" -> "Überwachung" die Werte zu CPU und Instanzen beobachten
- Dauert einige Minuten
- 2. Instanz wurde erzeugt

In Cloud9: md5sum Befehl mit Ctrl-C beenden

In EC2: Werte und Instanzen beobachten
- Dauert wieder einige Minuten
- 2. Instanz wird wieder beendet