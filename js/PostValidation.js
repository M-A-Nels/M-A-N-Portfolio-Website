var button = document.getElementById("Post");
var clear = document.getElementById("Clear");

$Title = document.getElementById("Title");
$BlogContent = document.getElementById("BlogContent");

if(document.referrer == "http://localhost/Project/PreviewBlog.php")
{
    $Title.value = localStorage.getItem("PreviewTitle");
    $BlogContent.value = localStorage.getItem("PreviewBlogContent");
}
else
{
    localStorage.clear();
}


if(button){
    button.addEventListener("click", 
    function (event)
    {
        if($Title.value == "")
        {
            originalColor1 = $Title.parentElement.style.backgroundColor;
            event.preventDefault();
            $Title.parentElement.style.backgroundColor = "pink";
            $Title.value = "Testing";
        }

        if($BlogContent.value == "")
        {
            originalColor2 = $BlogContent.parentElement.style.backgroundColor;
            event.preventDefault();
            $BlogContent.parentElement.style.backgroundColor = "pink";
        }

        if($Title.value == "" || $BlogContent.value == ""){
            setTimeout(function(){
                $Title.parentElement.style.backgroundColor = originalColor1;
                $BlogContent.parentElement.style.backgroundColor = originalColor2;
            }, 3000);
        }
        else{
            localStorage.setItem("PreviewTitle", $Title.value);
            localStorage.setItem("PreviewBlogContent", $BlogContent.value);
        }

    });
}
        


if(clear){
    clear.addEventListener("click",
    function (event)
    {
        if (!confirm("Are you sure you wish to clear?")) {
            event.preventDefault();
        }

    });
}
