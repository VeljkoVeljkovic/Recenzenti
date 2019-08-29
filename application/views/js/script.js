
function hint()
            {
                var vr=document.FormaKupac.username.value;
                xmlhttp=new  XMLHttpRequest();
                xmlhttp.onreadystatechange = function()
                {
                    if(this.readyState==4 && this.status==200)
                    {
                       
                       document.getElementById("predlozi").innerHTML = this.responseText;
                    }
                }
                xmlhttp.open("POST", "autocomplete.php?tekst="+vr, true);
                xmlhttp.send();
            }
           
            
            function izbor(vrednost) {
                document.autocomplete.tekst.value=vrednost;
                document.getElementById("predlozi").innerHTML = "";
            }

