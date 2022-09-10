window.addEventListener("load", event => {

  var swiperWrapper = document.querySelector('.swiper-wrapper');

  /* data Team */
  var team = [{
          name: "Allan",
          role: "Product Owner - Developer",
          desc: "Far far away, behind the world mountains, far from the countries Vokalia and Consonantia, theres live the blind texts.",
          photo: "https://i.imgur.com/yUeDBTi.jpg",
          website: "https://rafaelalucas.com",
          email: "mailto:rafaelavlucas@gmail.com",
          linkedin: "https://www.linkedin.com/in/rafaelalucas/",
          dribbble: "https://dribbble.com/rafaelalucas",
      },
      {
          name: "Edouard",
          role: "Lead Developer - Git Referent",
          desc: "Far far away, behind the world mountains, far from the countries Vokalia and Consonantia, theres live the blind texts.",
          photo: "https://i.imgur.com/Ck5YKwI.jpg",
          website: "https://rafaelalucas.com",
          email: "mailto:rafaelavlucas@gmail.com",
          linkedin: "https://www.linkedin.com/in/rafaelalucas/",
          dribbble: "https://dribbble.com/rafaelalucas",
      },
      {
          name: "Nico",
          role: "Scrum Master - Developer",
          desc: "Far far away, behind the world mountains, far from the countries Vokalia and Consonantia, theres live the blind texts.",
          photo: "https://i.imgur.com/5S4gdKZ.jpg",
          website: "https://rafaelalucas.com",
          email: "mailto:rafaelavlucas@gmail.com",
          linkedin: "https://www.linkedin.com/in/rafaelalucas/",
          dribbble: "https://dribbble.com/rafaelalucas",
      },
      {
          name: "Anthony",
          role: "Web Designer",
          desc: "Far far away, behind the world mountains, far from the countries Vokalia and Consonantia, theres live the blind texts.",
          photo: "",
          website: "https://rafaelalucas.com",
          email: "mailto:rafaelavlucas@gmail.com",
          linkedin: "https://www.linkedin.com/in/rafaelalucas/",
          dribbble: "https://dribbble.com/rafaelalucas",
      },
      {
          name: "Salah",
          role: "Tech Referent WordPress & SASS",
          desc: "Far far away, behind the world mountains, far from the countries Vokalia and Consonantia, theres live the blind texts.",
          photo: "https://i.imgur.com/VWoLIlQ.jpg",
          website: "https://rafaelalucas.com",
          email: "mailto:rafaelavlucas@gmail.com",
          linkedin: "https://www.linkedin.com/in/rafaelalucas/",
          dribbble: "https://dribbble.com/rafaelalucas",
      },
      
  ];

  /* Social Icons */
  var icons = [{
      iWebsite: "https://rafaelalucas.com/dailyui/6/assets/link.svg",
      iEmail: "https://rafaelalucas.com/dailyui/6/assets/email.svg",
      iLinkedin: "https://rafaelalucas.com/dailyui/6/assets/linkedin.svg",
      iDribbble: "https://rafaelalucas.com/dailyui/6/assets/dribbble.svg",
  }];

  var iWebsite = icons[0].iWebsite,
      iEmail = icons[0].iEmail,
      iLinkedin = icons[0].iLinkedin,
      iDribbble = icons[0].iDribbble;


  /* Function to populate the team members */
  function addTeam() {
      for (let i = 0; i < team.length; i++) {

          /* Variables for the team */
          var name = team[i].name,
              role = team[i].role,
              desc = team[i].desc,
              photo = team[i].photo,
              website = team[i].website,
              email = team[i].email,
              linkedin = team[i].linkedin,
              dribbble = team[i].dribbble;

          /* Template for the Team Cards */
          var template = `
              <div class="swiper-slide">
              <div class="card">
                  <span class="bg"></span>
                  <span class="more"></span>
                  <figure class="photo"><img src="${photo}"></figure>
                      <article class="text">
                          <p class="name">${name}</p>
                          <p class="role">${role}</p> 
                          <p class="desc">${desc}</p> 
                      </article>
                      
                      <div class="social">
                      <span class="pointer"></span>
                      <div class="icons">
                          <a class="icon" href="${website}" target="_blank" data-index="0"><img src="${iWebsite}"></a>
                          <a class="icon" href="${email}" target="_blank" data-index="1"><img src="${iEmail}"></a>
                          <a class="icon" href="${linkedin}" target="_blank" data-index="2"><img src="${iLinkedin}"></a>
                          <a class="icon" href="${dribbble}" target="_blank" data-index="3"><img src="${iDribbble}"></a>
                          </div>
                          </div>
                  </div>
              </div>`;

          swiperWrapper.insertAdjacentHTML('beforeend', template);
      }
  };


  addTeam();



  /* Swiper Settings */

  var mySwiper = new Swiper(".swiper-container", {
      // Optional parameters
      direction: "horizontal",
      loop: true,
      centeredSlides: false,
      speed: 800,
      slidesPerView: 3,
      spaceBetween: 40,
      threshold: 5,


      // If we need pagination
      pagination: {
          el: ".swiper-pagination",
          clickable: true
      },

      // Navigation arrows
      navigation: {
          nextEl: ".swiper-button-next",
          prevEl: ".swiper-button-prev"
      },
      breakpoints: {
          1180: {
              slidesPerView: 2,
              spaceBetween: 40,
              centeredSlides: false,
          },
          799: {
              slidesPerView: 1,
              spaceBetween: 20,
              centeredSlides: true,
              loop: true,
          },
      }
  });

  /* Show More */

  var btnShow = document.querySelectorAll('.more');



  btnShow.forEach(function (el) {
      el.addEventListener('click', showMore);
  });

  function showMore(event) {
      var card = event.target.closest(".swiper-slide");

      if (card.classList.contains('show-more')) {
          card.classList.remove('show-more');
      } else {
          card.classList.add('show-more')
      }

  }


  /* Social Hover */
  var icon = document.querySelectorAll('.icon');

  icon.forEach(function (el) {
      el.addEventListener("mouseenter", followCursor);

  });


  function followCursor(event) {
      var pointer = event.currentTarget.closest(".swiper-slide").querySelector('.pointer'),
          index = event.currentTarget.dataset.index,
          sizeIcon = (60 * index) + 25;

      pointer.style.transform = `translateX(${sizeIcon}px)`;
  }


  /* end */
});Swiper