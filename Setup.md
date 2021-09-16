# Setup

## 1) IAM User erstellen

In IAM (AWS Konsole -> Services -> IAM):
- Bentzer -> Benutzer erstellen

Schritt 1:
- Name: ich (oder was anderes)
- Zugriffstyp: Zugriffsschlüssel und Passwort
- Konsolenpasswort: Benutzerdefiniert, Passwort eingeben
- ZUrücksetzen ... erfordern: nein

Schritt 2:
- Vorhandene Richtlinien direkt anfügen
- Richtlinien:
  - PowerUserAccess
  - IAMReadOnlyAccess
  - IAMSelfManageServiceSpecificCredentials
  - IAMUserSSHKeys
  - IAMUserChangePassword
- Weiter, Weiter, Benutzer erstellen

Oben rechts: Benutzerdropdown öffnen
- Accountnummer notieren
- Logout

Neu einloggen als IAM User
- Account ID eintragen
- User: Name aus Schritt 1
- Passwort
- Login


## 2) AWS CLoud9 einrichten

In Cloud9 (AWS Konsole -> Services -> Cloud9):
- Create Environment
- Name: aws-kurs
- Einstellungen lassen
- Next, Erstellen

Warten bis Umgebung läuft

In Cloud9 (Umgebung)
- Clone from Github (rechts im Welcome-Dialog)
- `https://github.com/dswd-cc/aws-kurs.git` hinten an Befehl anhängen, [Enter]


## 3) Optional: Sharing im Team