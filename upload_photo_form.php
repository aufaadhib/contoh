<!DOCTYPE html>
<html lang="en">
    
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Photo</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <h2>Upload New Profile Photo</h2>
    <form action="upload_photo.php" method="POST" enctype="multipart/form-data">
        <input type="file" name="photo" accept="image/*" required>
        <button type="submit">Upload Photo</button>
    </form>
</body>
</html>
