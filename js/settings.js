document.addEventListener("DOMContentLoaded", script);

function script()
{
  const fileInput = document.getElementById("file");
	const btns      = [
    document.getElementById("edit_pic"),
    document.getElementById("edit_username"),
    document.getElementById("edit_notifications"),
    document.getElementById("edit_email"),
    document.getElementById("edit_password")
  ];


  function attachEditListener(value)
  {
    value.addEventListener("click", function(e)
    {
      const el   = e.currentTarget;
      const next = el.nextElementSibling;

      next.classList.toggle("hide");
    });
  }

  btns.forEach(attachEditListener);
  
  function onFileInputChange(e)
  {
    const reder = new FileReader();
    const file  = fileInput[0];
    const img   = document.getElementById("pic");

    if (!file.type.startsWith("image/"))
      return;

    reader.onload = function()
    {
      return function(e)
      {
        img.src = e.target.result;
      };
    };

    reader.readAsDataURL(file);
  }

  fileInput.addEventListener("change", onFileInputChange);
}