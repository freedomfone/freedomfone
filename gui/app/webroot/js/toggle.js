function toggle(a)
{
    var e = document.getElementById(a);
     if(!e) return true;
      if(e.style.display == "none")
      {
           e.style.display = "block"
     }
      else
      {
           e.style.display = "none"
      }
      return true;
} 