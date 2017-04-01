## Configuration

This assumes you have everything installed correctly. See [readme](https://github.com/hutchgrant/tubman/blob/master/README.md) for prerequisites and installation

1) tools -> import -> WordPress: Run Importer
---------------------------------------------
upload wp-content/themes/tubman/data.xml

2) appearance -> tubman settings
-----------------------------
set Style
set social media

Front Page Settings:
set front page left block: events
set front page right block: news

set copyright: 2017 yourname

3) appearance -> customize -> static front page
-----------------------------------------------
set static from page - > Home


4) appearance -> customize -> site Identity
-----------------------------------------------
set Logo upload 
set site title 
set site icon

5) appearance -> customize -> menu locations
-----------------------
primary navigation -> About

Research Menu -> Research

YorkU footer menu -> YorkU footer

6) appearance -> customize -> customizing widgets -> Footer Left
----------------------------------------------
Add widget -> Text

Example text:

Title: Your Research Institute

Content:

```
<ul class="foot-nav-lt">
<li>321 York Lanes</li>
<li>York University</li>
<li>North York, Ontario</li>
<li>Postal Code?</li>
<li>&nbsp;</li>
<li><a href="./contact-us">Contact Us</a></li>
</ul>
```

6) appearance -> customize -> customizing widgets -> Footer Right
----------------------------------------------
Title: York University
Select Menu: YorkU footer

8) appearance -> customize -> customizing widgets -> Front Page Top
----------------------------------------------
Add Widget -> Jssor Widget
Add Widget -> Promo Widget

To upload and fill these widgets go to appearance -> widgets
- Select Front Page Top, 
- Select JSSOR Widget
- Select Upload Image, Select your uploaded image, then make sure you set size to full size, 
- Select "File URL" then "insert into post"
- Optionally you may set a URL that the slide will link to e.g. a page or post
- Optionally you may wish to set a caption

Save it and you will have the option of adding additional slides

Do the same procedure with the "Promo" widget. Recommend you set 3 images, for example tubman/img/mission.png handshake.png soccer.png 

9) appearance -> menus
-----------------------
Select a Menu to edit: About

- add any pages/categories you want to be shown at the top

Select a Menu to edit: YorkU Footer

- add any pages/categories you want to be shown at in the footer on the right

Select a Menu to edit: Research

- add any pages/categories you want to be shown on the research page

10) appearance -> widgets
----------------------------
Add JSSOR Widget to Arts Top, Community Top, Research Top
Add Slick Widget to Community Bottom

Fill each of them following the same procedure as step 7



