# How to use APIs
### ```/devs/presensi.json```
---
Method: **GET**
Params 
* **card_id** : RFID Number (like 12 34 56 78) 
* **device_id** : Your Device ID 

Return
* ```code``` -> Response Code
* ```result``` -> Response Message (string/array)

Result:
* 200: Response bahwa card tersebut terdaftar (```nim```, ```nama```, ```card_id```)
* 401: Device ID belum terdaftar atau kosong
* 403: Device ID belum terdaftar
* 404: Card belum terdaftar
* 
### ```/devs/tambah_kartu.json```
---
Method: **GET**
Params 
* **card_id** : RFID Number (like 12 34 56 78) 
* **device_id** : Your Device ID 

Return
* ```code``` -> Response Code
* ```result``` -> Response Message

Result:
* 0: Response bahwa card tersebut sudah terdaftar sebelumnya
* 1: Response bahwa card tersebut berhasil didaftarkan
* 401: Device ID belum terdaftar atau kosong
* 403: Device ID belum terdaftar
* 404: Card belum terdaftar
