<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>form</title>
      <script
  src="https://code.jquery.com/jquery-3.7.1.js"
  integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
  crossorigin="anonymous"></script>
  <link rel="stylesheet" href="students_li.css">
  <script>
    function class_set(){
    var x = document.getElementById("class_nm1").value;
    $.ajax({
      url: "test.php",
      method: "POST",
      data: {
        id:x
      },
      success:function(data){
        $("#ans").html(data);
      }
    });
    }
  </script>
</head>
<body>
</div>
    <form action="insert.php" method="post">
        <label for="search_bar">Search: </label>
        <input type="text" name="class_nm1" id="class_nm1" onchange="class_set()" >
        <button username="submit" type="submit">Submit</button>
    </form>
    <div>
        <table width=75%>
            <tr>
            <th>Reg No.</th>
            <th>Class</th>
            <th>Student Name</th>
            <th>Father Name</th>
            <th>DoB</th>
            <th>Edit</th>
            <th>Delete</th>
            </tr>
            <tbody id ="ans"></tbody>
            </table>
        </div>
</body>
</html>