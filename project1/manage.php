<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Web Weavers manager page">
    <meta name="keywords" content="Manage, Jobs, Interest">
    <meta name="author" content="Rose Healy">
    <link rel="stylesheet" href="styles/styles.css">
    <!--Fonts-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Economica:ital,wght@0,400;0,700;1,400;1,700&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <title>Manager profile</title>
</head>
<body>
    <header>
            <nav aria-label="Main Navigation">
            <a href="index.html"><img src="images/web_weavers_logo.jpg" id = "home_logo"    
                alt="Dark purple spiderweb against a lighter purple background with text reading 'Web Weavers'" 
                title="Web Weavers Company Logo">  <!-- Company logo created on Canva-->
            </a>
            <ul class="navbar">
                <li class="page-links"><a href="jobs.html">Current Opportunities</a></li>
                <li class="page-links"><a href="apply.html">Apply Now</a></li> 
                <li class="page-links"><a href="about.html">About Us</a></li> 
            </ul>
            <ul class="nav_buttons">
                <li><a href="index.html">Log In</a></li>
                <li><a href="index.html">Get Started</a></li>
            </ul>
        </nav>
    </header>
    
    <h1>Manage</h1>
    <p>Welcome</p>
    <h2>View Expressions of Interest</h2>
    <form action="" method="post">
        <label for="list_all">
            <input type="radio" name="list_all" value="list_all" id="list_all">
            List all EOIs
        </label>
        <select name="list_by_ref" id="list_by_ref">
            <option value=" ">Please Select</option>
            <option value="COS01">COS01</option>
            <option value="COS02">COS02</option>
        </select>
        <input type="text" name="firstname" id="firstname">
        <input type="text" name="lastname" id="lastname">
        <select name="delete_by_ref" id="delete_by_ref">
            <option value=" ">Please Select</option>
            <option value="COS01">COS01</option>
            <option value="COS02">COS02</option>
        </select>
        <!-- add status change (once table appears?) -->
        <input type="submit" value="Request">
    </form>
    <footer>
        <a href="index.html"><img src="images/web_weavers_logo_only_pic.jpg" alt="Purple spiderweb from Web Weavers logo"></a>
        <p>&copy;&nbsp;2025 Web Weavers</p>
        <p>Email: <a href="mailto:info@webweavers.edu.au">info@webweavers.edu.au</a></p>
        <p>Link:
            <a href="https://tyler105919952.atlassian.net/jira/software/projects/WW/summary" target="_blank">
                Web Weavers Jira Project
            </a>
        </p>
        <p>Link:
          <a href="https://github.com/102347055/webweavers-project-part1" target="_blank">
              Web Weavers Github Repository
          </a>
      </p>
    </footer>
</body>
</html>