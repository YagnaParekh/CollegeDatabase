window.addEventListener("load", function()
{
    $(document).ready(function()
    {
        function success(student)
        {
            $(".reset").remove();

            for(let i = 0; i < 10; i++)
            {
                let node = $("<tr>").append("<td>" + student[i]["name"] +
                    "</td><td>$" + student[i]["grade"] +
                    "</td>").addClass("reset");
                $("table").append(node);
            }
        }

        function success(a)
        {
            let node = $("<p>").html(a).addClass("update");
            $("body").append(node);
        }

        $("#submit").click(function()
        {
            $(".update").remove();
            $("#message").text("");

            let studentName1 = $("#studentName1").val();
            let studentGrade1 = $("#studentGrade1").val();
            let studentName2 = $("#studentName2").val();
            let studentGrade2 = $("#studentGrade2").val();
            let studentName3 = $("#studentName3").val();
            let studentGrade3 = $("#studentGrade3").val();

            let is_valid1 = false;
            let is_valid2= false;
            let is_valid3 = false;
            let is_valid = false;
            let student_list = [];

            // first student
            if(!((studentName1 == "" || (studentGrade1 == ""))))
            {
                is_valid1 = true;
                student_list.push([studentName1, studentGrade1]);
            }
            else
            {
                is_valid1 = false;
            }

            //second student
            if(!((studentName2 == "" || (studentGrade2 == ""))))
            {
                is_valid2 = true;
                student_list.push([studentName2, studentGrade2]);
            }
            else
            {
                is_valid2 = false;
            }


            //third student
            if(!((studentName3 == "" || (studentGrade3 == ""))))
            {
                is_valid3 = true;
                student_list.push([studentName3, studentGrade3]);
            }
            else
            {
                is_valid3 = false;
            }

            is_valid = is_valid1 || is_valid2 || is_valid3;
            if(is_valid)
            {
                for(item of student_list)
                {
                    let params = "studentname=" + item[0] + "&studentgrade=" + item[1];
                    fetch ("Add.php", {
                            method: 'POST',
                            credentials: 'include',
                            headers:{"Content-Type":"application/x-www-form-urlencoded"},
                            body:params

                    })
                    .then(response => response.text())
                    .then(success)
                }
            }
            else
            {
                $("#message").text("Invalid Input");
            }
        });
    });
})