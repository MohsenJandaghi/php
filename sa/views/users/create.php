
<html lang="">
<head></head>
<body>
<form action="<?=controller('User')?>" method="POST">
    <label for="name">Name:</label><br/>
    <input type="text" name="name" id="name"><br/>

    <label for="family">Family:</label><br/>
    <input type="text" name="family" id="family"><br/>

    <label for="phone">Phone:</label><br/>
    <input type="text" name="phone" id="phone"><br/>

    <input type="submit" value="Save User">
</form>
</body>
</html>
