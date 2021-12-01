<h1>My Name Is {$Name}</h1>
<h1>My Surname Is {$Surname}</h1>
<h2>My class is {$Class}</h2>
<h3>I in {$Group} Group</h3>


<ul>
{section name=i loop=$StudentsName}
            
     
            <li> {$StudentsName[i]} {$StudentsSurname[i]}</li> 
      
        {sectionelse}
        Nie znaleziono
    {/section}
</ul>