
GET SERVICES....
<br><br><br>
//http://projectmanager/lookagram/services/ws-user.php?type=signup&signature=8227326a40ba1fc3ac84e452aba123f9fa31cb2e&data=[{"username":"ravi","fname":"Ravikant","lname":"Bhargav","password":"123456","email":"ravikant@ninehertzindia.com","dob":"2015-1-15","gender":"MAIL","zipcode":"302020","device_token":"302020","thumb_image":"uploads/default_img.png"}]<br>
//http://projectmanager/lookagram/services/ws-user.php?type=LOGIN&signature=7c7ca32d5e5637d183ba42042b20acf5eae3a560&data=[{"username":"ravikant","password":"123456789","device_token":"302020"}]<br>
<br>
//http://projectmanager/lookagram/services/ws-user.php?type=FORGOT&signature=bda723ecc46406b29d10a7a48131fe5d3a7f035a&data=[{"email":"ravikant@ninehertzindia.com"}]
<br>
////http://projectmanager/lookagram/services/ws-user.php?type=change&signature=d293c7a6bd5337da9d21e1f06d5f45316cc5d19d&data=[{"userid":"4","oldpass":"123456789","newpass":"123456789"}]
<br>
//http://projectmanager/lookagram/services/ws-user.php?type=GET&signature=fd825242dd09c7b8ebfa3fb51f6a165a772c68f2&data=[{"userid":"4","friend_id":"12"}]
<br>
//http://projectmanager/lookagram/services/ws-user.php?type=EDIT&signature=b9eb1b6a323666a70db4f641e07708f585e6f550&data=[{"userid":"4","username":"ravi","fname":"Ravikant Bhargav","lname":"Ravikant Bhargav","email":"ravikant@ninehertzindia.com","gender":"MALE","user_bio":"Basic info","phone":"123456789","location":"jaipur","account_status":"private","thumb_image":"no-image.jpeg"}]
<br>
//http://projectmanager/lookagram/services/ws-user.php?type=verify&signature=eca58e36c8f62a5468b473d3cb770ddb9add3fff&data=[{"username":"admi3n","email":"as@a.com"}]
<br>
<br>//http://projectmanager/lookagram/services/ws-user.php?type=resendmail&signature=5379c0ade9c9e60686db9379db984c648273aaed&data=[{"email":"ravikant@ninehertzindia.com"}]
<br>//http://projectmanager/lookagram/services/ws-user.php?type=FACEBOOKLOGIN&signature=4f8d19a50c5696aae3e78a44772193f7fb4a0286&data=[{"fname":"Ravikant Bhargav","lname":"Ravikant Bhargav","email":"ravikant@ninehertzindia.com","gender":"MALE","dob":"2015-1-15","facebookid":"private","image":"no-image.jpeg"}]
<br>//http://projectmanager/lookagram/services/ws-user.php?type=USERPOSTS&signature=d293c7a6bd5337da9d21e1f06d5f45316cc5d19d&data=[{"userid":"4","friend_id":"2"}]
<br>//http://projectmanager/lookagram/services/ws-user.php?type=SEARCH&signature=d293c7a6bd5337da9d21e1f06d5f45316cc5d19d&data=[{"userid":"31","keyword":"am","type":"HASHTAG"}]
<br>//http://projectmanager/lookagram/services/ws-user.php?type=MYNOTIFICATION&signature=d293c7a6bd5337da9d21e1f06d5f45316cc5d19d&data=[{"userid":"31"}]
<br>//http://projectmanager/lookagram/services/ws-user.php?type=FOLLOWERSNOTIFICATION&signature=d293c7a6bd5337da9d21e1f06d5f45316cc5d19d&data=[{"userid":"31"}]
<br>//http://projectmanager/lookagram/services/ws-user.php?type=SUGGESTION&signature=d293c7a6bd5337da9d21e1f06d5f45316cc5d19d&data=[{"userid":"31"}]
<br>//http://projectmanager/lookagram/services/ws-user.php?type=SAVEUSERCONTACTS&signature=d293c7a6bd5337da9d21e1f06d5f45316cc5d19d
<br>//http://projectmanager/lookagram/services/ws-user.php?type=GETUSERCONTACTS&signature=b1290e837aa935c2963d3ff198af86a5a5fc3a91&data=%5B{%22userid%22:%2248%22}%5D

_______________________________________________________________________________________________________
<br><br>

<?php
$host=$_SERVER['HTTP_HOST']."/lookagram";


?>

ADD POST<br><br>
url : lookagram/services/ws-post.php?type=ADDPOST&signature=1970c1180c303fc80e84b79fff427ddaf3df9d47<br>
post_keys : title,type[audio/video],userid,data(file of audio and video),image(image for video or optional for audio)<br>
Response :  status, msg ,post_id, type, data_url, image<br>
<br>
<form method="post" enctype="multipart/form-data" action="http://<?=$host?>/services/ws-post.php?type=ADDPOST&signature=1970c1180c303fc80e84b79fff427ddaf3df9d47">
   title <input type="" value="test" name="title" /><br>
   type <input type="" value="audio" name="data_type" /><br>
   user_id <input type="" name="userid" value="12" /><br>
   audio/video <input type="file" name="data" value="" /><br>
    image <input type="file" name="image" value="" /><br>
   <input type="submit"  value="submit"/>
</form>
_______________________________________________________________________________________________________
<br><br>
GET Contacts<br><br>
url : lookagram/services/ws-user.php?type=GETUSERCONTACTS&signature=6d316ed2282e4b01e5a3ff09fcaeade7cff5609d<br>
post_keys : userid,contacts[json],contact_type(USERCONTACT,FACEBOOK)<br>
Response :  status, msg <br>
<br>
<form method="post" enctype="multipart/form-data" action="http://<?=$host?>/services/ws-user.php?type=GETUSERCONTACTS&signature=fdd603c5c6e8095d2f080c28f8b44cd179a81403">
   user_id <input type="" value="48" name="userid" /><br>
   contacts <input type="text" name="contacts" value='[{"name":"aman","email":"jain@hsds.com"}]' /><br>
 
   <input type="submit"  value="submit"/>
</form>
_______________________________________________________________________________________________________
<br><br>
<br><br>
Follow All<br><br>
url : lookagram/services/ws-follow.php?type=FOLLOWALL&signature=94b5969accb569d25c02074fd2faab22efeb3cc8<br>
post_keys : userid,users[json]<br>
Response :  status, msg <br>
<br>
<form method="post" enctype="multipart/form-data" action="http://<?=$host?>/services/ws-follow.php?type=FOLLOWALL&signature=94b5969accb569d25c02074fd2faab22efeb3cc8">
   user_id <input type="" value="48" name="userid" /><br>
   users <input type="text" name="users" value='[{"userid":"1"}]' /><br>
 
   <input type="submit"  value="submit"/>
</form>
_______________________________________________________________________________________________________
<br><br>