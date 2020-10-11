# Raspberry PI REST API

By [Clément Ronzon](https://www.linkedin.com/in/clemrz/). Licensed under [MIT License](https://choosealicense.com/licenses/mit/).

This is a small REST API I wrote for a Raspberry Pi Zero W. I use it to dialogue with several home-made ESP8266-based IoT devices in my house.

## Deployment with docker-compose

### Requirements

Docker version `19.03.0+`

### Steps

Clone this repository on your machine:

```shell script
$ git clone https://github.com/ClemRz/raspi-api.git
$ cd raspi-api
```

Make sure you rename `src/.env.example` to `src/.env` and fill in the information.

Launch the services:

```shell script
$ sudo docker-compose up
```

Test the API: http://localhost:8081/api/--TODO--

## API reference --TODO--

 - Protocol: `REST`
 - Endpoint: `/`
 - URL format: `/api/device/{device ID}/entry`
 - Methods: `POST`
 - Authentication: none
 - Mandatory fields:
   * `device ID`:
     + Description: ID of the device
     + Type: string
   * Body:
     + Type: JSON
     + Format: `[["key1", "value1"],["key2", "value2"], ...]`
 
 ### Examples --TODO--
 
Request: `/api/device/123abc/entry`

Body: `[["key1", "value1"],["key2", "value2"]]`

Response: 
 ```json
{
    "status": "success"
}
```
---
Request: `/api/device/123abc/entry`

Body: `[["key1", "value1"],["key2", "value2"`

Response: 
 ```json
{
    "error": {
        "message": "Syntax error",
        "code": 4
    }
}
```

## Troubleshooting

If you get a `404` or an empty array as a response of the API then maybe something went wrong during the setup.

When using docker-compose, the logs are mapped to the `log` folder at the root of the project (volume). There you will find Apache's logs.
