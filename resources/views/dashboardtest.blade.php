<section class="home">
    <div class="text"></div>
    <link rel="stylesheet" href="css/dashboard.css">
      <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
      <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</section>
<body>
      <section class="navigation"><!--nav-->
      </section><!--nav end-->
      <section class="main"><!--main-->
          <div class="title">
            <h1>My project</h1>
            <form action="#">
              <label for="projects">Sort By</label>
              <select name="projects" id="projects">
                <option value="recent">Recent Project</option>
                <option value="finished">Finished Project</option>
                <option value="ongoing">Ongoing Project</option>
              </select>
            </form>
          </div>
          <div class="project_list"><!-- Project List -->
            <div class="project"> <!-- Project1-->
              <div class="category"></div>
                <h2>Inventory</h2>
                <p>Active recently</p>

                <ul class="activity">
                  <li>Coming soon banner</li>
                  <li>Book Cover</li>
                </ul>

                <div class="meta">
                  <div class="contributors">
                    <img src="TA/public/Fortnite.jpg" alt="">
                    <img src="TA/public/Fortnite.jpg" alt="">
                    <img src="TA/public/Fortnite.jpg" alt="">
                  </div>
                  <span class="material-symbols-outlined">more_vert</span>
                </div>
              </div> <!-- Project1 end-->

              <div class="project"> <!-- Project2-->
              <div class="category"></div>
                <h2>Planning</h2>
                <p>1 hour ago</p>

                <ul class="activity">
                  <li>editorial page content</li>
                </ul>

                <div class="meta">
                  <div class="contributors">
                    <img src="TA/public/Fortnite.jpg" alt="">
                    <img src="TA/public/Fortnite.jpg" alt="">
                    <img src="TA/public/Fortnite.jpg" alt="">
                  </div>
                  <span class="material-symbols-outlined">more_vert</span>
                </div>
              </div> <!-- Project2 end-->            

              <div class="project"> <!-- Project4-->
              <div class="category"></div>
                <h2>Production</h2>
                <p>Active recently</p>

                <ul class="activity">
                  <li>Coming soon banner</li>
                  <li>Book Cover</li>
                </ul>

                <div class="meta">
                  <div class="contributors">
                    <img src="TA/public/Fortnite.jpg" alt="">
                    <img src="TA/public/Fortnite.jpg" alt="">
                    <img src="TA/public/Fortnite.jpg" alt="">
                  </div>
                  <span class="material-symbols-outlined">more_vert</span>
                </div>
              </div> <!-- Project4 end-->

              <div class="project"> <!-- Project5-->
              <div class="category"></div>
                <h2>Profile</h2>
                <p>Active recently</p>
                
                <ul class="activity">
                  <li>Coming soon banner</li>
                  <li>Book Cover</li>
                </ul>

                <div class="meta">
                  <div class="contributors">
                    <img src="TA/public/Fortnite.jpg" alt="">
                    <img src="TA/public/Fortnite.jpg" alt="">
                    <img src="TA/public/Fortnite.jpg" alt="">
                  </div>
                  <span class="material-symbols-outlined">more_vert</span>
                </div>
              </div> <!-- Project3 end-->
          </div><!-- Project List end -->
      </section><!--main end-->

      <section class="secondary"><!--secondary-->
          <div class="chart">
            <h2>Total Project</h2>
            <div>
              <canvas id="myChart" width="400" height="400"></canvas>
              <div class="complete">
                <h3>3 Completed</h3>
                <p>from 5 projects</p>
              </div>
            </div>
          </div>
          <div class="recent_project"><!--recent project-->
            <div class="listing">
              <div class="title">
                <div class="category">
                  <h2>Layouting</h2>
                  <p>by Bagus Mahardika</p>
                </div>
                <span class="material-symbols-outlined">more_vert</span>
              </div>
              <div class="listing">
              <div class="title">
                <div class="category">
                  
          </div><!--recent project end-->
      </section><!--secondary end-->

  <script>
  const ctx = document.getElementById('myChart');

  new Chart(ctx, {
    type: 'doughnut',
    data: {
      labels: ['Completed', 'Ongoing', 'Stalled'],
      datasets: [{
        label: '# of Votes',
        data: [12, 19, 3],
        borderWidth: 1
      }]
    },
    
  });
</script>
</body>