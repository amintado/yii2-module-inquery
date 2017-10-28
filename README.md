## inquery module
this module is like ticket system and created for [printing office](https://github.com/amintado/printing-office) app, but you can use it in another yii2 apps

## mechanism
1- add some category with ```index.php?inquery\inquery-category```

2- user will create an inquery request (An inquiry contains the request text,subject from the list of subjects,attachments)

3- The queue is queried for the answer.

4- admin will answer to inquery and inquery status will change to 'answered'.

5- then user will view your answer


## Screenshots
![screenshot-2017-10-28 inqueries 1](https://user-images.githubusercontent.com/11722893/32133798-03f0f85e-bbec-11e7-9371-f9b66254dcbb.png)
![screenshot-2017-10-28 inqueries](https://user-images.githubusercontent.com/11722893/32133799-042b8cbc-bbec-11e7-8434-d1d60b0f7d33.png)
![screenshot-2017-10-28 inquery in time 2017-10-02](https://user-images.githubusercontent.com/11722893/32133800-046195a0-bbec-11e7-9e06-d70adbf92382.png)
![screenshot-2017-10-28 1](https://user-images.githubusercontent.com/11722893/32133801-04992a92-bbec-11e7-94a2-182b44510644.png)
![screenshot-2017-10-28](https://user-images.githubusercontent.com/11722893/32133802-04ce26a2-bbec-11e7-824d-53ee14a29c0b.png)
![screenshot-2017-10-28 1](https://user-images.githubusercontent.com/11722893/32133803-0504aaf6-bbec-11e7-8f8a-2a069c2166ea.png)
![screenshot-2017-10-28](https://user-images.githubusercontent.com/11722893/32133804-05398eec-bbec-11e7-8484-ff1cc5410b8c.png)
![screenshot-2017-10-28 2017-10-02](https://user-images.githubusercontent.com/11722893/32133805-056ef44c-bbec-11e7-9ce3-8ca5be8d8cb7.png)

## Methods
this module has 5 event method:
* afterCreate($model); this method runs after created an inquery
* afterAnswer($model); this method runs after an inquery answered
* afterViewed($model); this method runs when admin seen an inquery
* CreateError($model); this method runs when an error occur in inquery create process
* AnswerError($model); this method runs when an error occur in inquery answer process


for use this methods you must create a Class that implements 'amintado\inquery\EventInterface' interface

for Example can use 'amintado\inquery\Event' class

Or you can create a class that extend from 'amintado\inquery\Event' class

Method are useful for send email,sms after an inquery action

## config
add this code to ```app/config/main.php``` file:
```
 'inquery'=> [
            'class'=>amintado\inquery\Module::className()
        ],
```

## Module Parameters
* $jalaliDate :if you want use this module in ``persian`` language, you can change this parameter to `true`, then all dates will show in shamsi(jalali) format
* $filesDirectory :set your custom directory for upload inquery attachments,default value is `'@frontend/dl'` 
* downloadUrl :set your upload directory Url,default URL is `'http://taban.dev/frontend/dl'`

**Dont Use '/' Character in the end of ``$downloadUrl`` parameter value**

* $eventClass :set your custom Event class namespace here(your class must implement from `'amintado\inquery\EventInterface'` interface OR extend from `'amintado\inquery\Event'` class)

## migration
for apply tables in your database,run this command:
```
yii migrate --migrationPath=@vendor/amintado/yii2-module-inquery/migration
```

## URL
```
index.php?inquery/default
index.php?inquery/inquery-category
index.php?inquery/manage
```

## localization
this module now translated to persian language
you can Fork and send pull request in 'master' branch to translate it to your language

## languages
-[X] Persian:Full
-[X] English:90%

## date
- [X] Jalali/Shamsi
- [X] Gregorian

## credits
* [amintado](https://github.com/amintado) programming and improve this module
* [kartik-v](https://github.com/kartik-v) create best GridView module for yii2 framework

## Lisence
GNU General Public License v3.0



