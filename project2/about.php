<!DOCTYPE html>
<html lang="en" >
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="styles/styles.css">
        <!-- Fonts for styling text -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Economica:ital,wght@0,400;0,700;1,400;1,700&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
        <title>About Web Weavers</title>
    </head>
    <body>
        <?php include 'header.inc'; ?>
        <div class="about_page">
            <fieldset id="class_header" class="about-fieldset">
            <h2>Web Weavers</h2>

            <!-- Class details -->
            <h3>Class Information</h3>
            <ul id="header_list">
                <li>Web Technology
                    <ul>
                        <li>Thursday</li>
                        <li>12:30pm - 2:30pm</li>
                        <li>Tutor: Nick</li>
                    </ul>
                </li>
            </ul>
            </fieldset>

            <div class="id_rightside">
            <!-- Group member tasks -->
            <fieldset id="contributions_fieldset" class="about-fieldset">
            <h3>Members' Contributions</h3>
            <dl id="group_jobs">
                <dt><u>Rayan Arain</u></dt>
                <dd>Part 1: home.html, review Tyler's about.html, ask questions on behalf of the group</dd>
                <dd>Part 2: use PHP to reuse common elements (task 1), settings.php (task 2), about.php (task 6), enhancements (task 8)</dd>
                <dd>&nbsp;</dd>

                <dt><u>Rose Healy</u></dt>
                <dd>Part 1: apply.html, review Rayan's home.html, submit deliverables</dd>
                <dd>Part 2: manage.php (task 5), submit deliverables</dd>
                <dd>&nbsp;</dd>

                <dt><u>Damian Moisidis</u></dt>
                <dd>Part 1: jobs.html, review Rose's apply.html</dd>
                <dd>Part 2: EOI table (task 3), process_eoi.php (task 4)</dd>
                <dd>&nbsp;</dd>

                <dt><u>Tyler Graziano</u></dt>
                <dd>Part 1: about.html, jobs.html, review Damian's jobs.html</dd>
                <dd>Part 2: jobs description (task 7)</dd>
                <dd>&nbsp;</dd>


            </dl>
            </fieldset>

            <fieldset id="student_id" class="about-fieldset">
                <h3 id="id_heading">Student IDs</h3>
                <ul>
                    <li><u>Rayan Arain</u>
                        <ul>
                            <li>Student number: 106049216</li>
                            <li>&nbsp;</li>
                        </ul>
                    </li>
                    <li><u>Rose Healy</u>
                        <ul>
                            <li>Student number: 102347055</li>
                            <li>&nbsp;</li>
                        </ul>
                    </li>
                    <li><u>Damian Moisidis</u>
                        <ul>
                            <li>Student number: 105919952</li>
                            <li>&nbsp;</li>
                        </ul>
                    </li>
                    <li><u>Tyler Graziano</u>
                        <ul>
                            <li>Student number: 102347055</li>
                              <li>&nbsp;</li>
                        </ul>
                    </li>
                </ul>
                </fieldset>
            </div>

            <!-- Image and Interests Table side by side -->
            <!-- Image and Interests Table side by side -->
            <div class="interests-and-photo">
                <div class="group-photo-wrapper">
                    <fieldset id="photo_fieldset" class="about-fieldset">
                        <h3 id="photoheading">Group Photo</h3>
                        <img id="group_image" src="images/groupimage.jpg" alt="Photo of Web Weavers" width="300">
                    </fieldset>
                </div>

                <div class="interests-content">
                    <fieldset id="interests_fieldset" class="about-fieldset">
                        <table id="interests-table">
                            <caption><strong>Members Interests</strong></caption>
                            <thead>
                                <tr>
                                    <th>Student Name</th>
                                    <th>Interests 1</th>
                                    <th>Interests 2</th>
                                    <th>Interests 3</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Rayan Arain</td>
                                    <td>Watching daily life vlogs</td>
                                    <td>Designing flyers</td>
                                    <td>Trying new restaurants and foods</td>
                                </tr>
                                <tr>
                                    <td>Rose Healy</td>
                                    <td>Knitting & crocheting</td>
                                    <td>Reading</td>
                                    <td>Going to see musicals</td>
                                </tr>
                                <tr>
                                    <td>Damian Moisidis</td>
                                    <td>Bouldering/Rock-climbing</td>
                                    <td>Rollerblading</td>
                                    <td>Avid Movie watcher</td>
                                </tr>
                                <tr>
                                    <td>Tyler Graziano</td>
                                    <td>Working on my car</td>
                                    <td>Playing games</td>
                                    <td>Catching up with friends</td>
                                </tr>
                            </tbody>
                        </table>
                    </fieldset>
                </div>
            </div>

            <!-- Group description section -->
            <fieldset id="profile_fieldset" class="about-fieldset">
            <h3>Group Profile</h3>
            <p>Our group, Web Weavers, consists of four members with diverse interests and skills. We are passionate about web development and have experience in various programming languages and technologies </p>
            <br>

            <h4>Demographic Information</h4>
            <p>We come from different parts of the world, bringing unique perspectives and experiences to our projects.
                Rayan is a 22 year old woman who has a Pakistani ethnicity and culutre
                Rose is a 25 year old woman who comes from an english and irish cultrual background
                Damian is a young 25 year old man who is Australian born and raised with Greek heritage.
                Tyler is 18 years of age, born in Austrlia having a Greek and Italian background
            </p>
            <br>

            <h4>Hometown Descriptions</h4>
            <p>Each member of our group has a unique hometown, which has shaped their interests and skills.
                Rayan: Liverpool, NSW. A busy suburb where different cultures mix, giving a mix of city fun and quiet living. 
                Rose: Melbourne, lived in the south-east, east and northern suburbs
                Damian: Brighton known for its colourful beach boxes and Victorian architecture it offers a relaxed costal lifestyle.
                Tyler: Melbournes northern suburbs as well as Bright in regional Victoria 
            </p>
            <br>
            </fieldset>

            <!-- Favourite books, music and films -->
            <fieldset id="favourites_fieldset" class="about-fieldset">
                <h4>Favourite Books, Music, Films</h4>
                <div class="favourites">
                    <ul>
                        <li id="rayan_favourite"><u>Rayan Arain:</u> 
                            <ul>
                                <li>Book: The Courage to be Disliked by Fumitake Koga and Ichiro Kishimi </li>
                                <li>Music: Rock and old school k-pop </li>
                                <li>Films: Meet the Robinsons and The Karate kid </li>
                            </ul>
                            <br>
                        </li>
                        <li id="rose_favourite"><u>Rose Healy:</u>
                            <ul>
                                <li>Books: The Secret History, This Is How You Lose the Time War</li>
                                <li>Music: Love a range of music genres but listen to pop</li>
                                <li>Films: Howl's Moving Castle, The Lord of the Rings</li>
                            </ul>
                            <br>
                        </li>
                        <li id="damian_favourite"><u>Damian Moisidis: </u>
                            <ul>
                                <li>Books: Frank Herbert's Dune Book</li>
                                <li>Music: Seth Sentry, hip-hop</li>
                                <li>Films: Frank Herbert's Dune Film </li>
                            </ul>
                            <br>
                        </li>
                        <li id="tyler_favourite"><u>Tyler Graziano:</u>
                            <ul>
                                <li>Books: Runner </li>
                                <li>Music: Pop and Rap </li>
                                <li>Films: Prisoners</li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </fieldset>
        </div>

    <!-- Footer with contact and project link -->
        <hr>
        <?php include 'footer.inc'; ?>
    </body>
</html>