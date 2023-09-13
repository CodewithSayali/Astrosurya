
//  AOS.init();



 $(document).ready(function(){
    //  scroll-top-

      $(window).on('scroll', function () {
        if ($(document).scrollTop() > 100) {
            $('.menu-sec').addClass('back')
        } else {
            $('#masthead').removeClass('back')
        }
        ;
    });
    
     $(".whatwedo-item").hover(
      function () {
        $(this).addClass("active");
      },
      function () {
        $(this).removeClass("active");
      }
    ),
      $(".whatwedo-item-1").hover(
        function () {
          $(".whatwedo-item-2").addClass("inactive1");
            $(".whatwedo-item-3").addClass("inactive1");
            $(".whatwedo-item-4").addClass("inactive1");
            // $(".whatwedo-item-5").addClass("inactive1");
        },
        function () {
          $(".whatwedo-item-2").removeClass("inactive1");
            $(".whatwedo-item-3").removeClass("inactive1");
            $(".whatwedo-item-4").removeClass("inactive1");
        }
      );
      $(".whatwedo-item-2").hover(
        function () {
          $(".whatwedo-item-1").addClass("inactive2"),
            $(".whatwedo-item-3").addClass("inactive2");
            $(".whatwedo-item-4").addClass("inactive2");
        },
        function () {
          $(".whatwedo-item-1").removeClass("inactive2"),
            $(".whatwedo-item-3").removeClass("inactive2");
            $(".whatwedo-item-4").removeClass("inactive2");
        }
      );
      $(".whatwedo-item-3").hover(
        function () {
          $(".whatwedo-item-2").addClass("inactive3"),
            $(".whatwedo-item-1").addClass("inactive3");
            $(".whatwedo-item-4").addClass("inactive3");
        },
        function () {
          $(".whatwedo-item-2").removeClass("inactive3");
            $(".whatwedo-item-1").removeClass("inactive3");
            $(".whatwedo-item-4").removeClass("inactive3");
        }
      );
      $(".whatwedo-item-4").hover(
        function () {
          $(".whatwedo-item-1").addClass("inactive4");
            $(".whatwedo-item-2").addClass("inactive4");
            $(".whatwedo-item-3").addClass("inactive4");
        },
        function () {
          $(".whatwedo-item-1").removeClass("inactive4");
            $(".whatwedo-item-2").removeClass("inactive4");
            $(".whatwedo-item-3").removeClass("inactive4");
        }
      );
       $(".whatwedo-item-5").hover(
        function () {
          $(".whatwedo-item-6").addClass("inactive5");
            $(".whatwedo-item-7").addClass("inactive5");
            $(".whatwedo-item-8").addClass("inactive5");
        },
        function () {
          $(".whatwedo-item-6").removeClass("inactive5");
            $(".whatwedo-item-7").removeClass("inactive5");
            $(".whatwedo-item-8").removeClass("inactive5");
        }
      );
      $(".whatwedo-item-6").hover(
        function () {
          $(".whatwedo-item-5").addClass("inactive6");
            $(".whatwedo-item-7").addClass("inactive6");
            $(".whatwedo-item-8").addClass("inactive6");
        },
        function () {
          $(".whatwedo-item-5").removeClass("inactive6");
            $(".whatwedo-item-7").removeClass("inactive6");
            $(".whatwedo-item-8").removeClass("inactive6");
        }
      );
      $(".whatwedo-item-7").hover(
        function () {
          $(".whatwedo-item-6").addClass("inactive7");
            $(".whatwedo-item-5").addClass("inactive7");
            $(".whatwedo-item-8").addClass("inactive7");
        },
        function () {
          $(".whatwedo-item-6").removeClass("inactive7");
            $(".whatwedo-item-5").removeClass("inactive7");
            $(".whatwedo-item-8").removeClass("inactive7");
        }
      );
      $(".whatwedo-item-8").hover(
        function () {
          $(".whatwedo-item-5").addClass("inactive8");
            $(".whatwedo-item-6").addClass("inactive8");
            $(".whatwedo-item-7").addClass("inactive8");
        },
        function () {
          $(".whatwedo-item-5").removeClass("inactive8");
            $(".whatwedo-item-6").removeClass("inactive8");
            $(".whatwedo-item-7").removeClass("inactive8");
        }
      );
 });
    

// =====about-counder====
 //=======counter======
 const counters = document.querySelectorAll('.counter');
const speed = 200; // The lower the slower

counters.forEach(counter => {
	const updateCount = () => {
		const target = +counter.getAttribute('data-target');
		const count = +counter.innerText;

		// Lower inc to slow and higher to slow
		const inc = target / speed;

		// console.log(inc);
		// console.log(count);

		// Check if target is reached
		if (count < target) {
			// Add inc to count and output in counter
			counter.innerText = count + inc;
			// Call function every ms
			setTimeout(updateCount, 1);
		} else {
			counter.innerText = target;
		}
	};

	updateCount();
});






// =======menu-fixed======

// $(document).ready(function(){
//   $(window).on('scroll', function(){
//   if ($(document).scrollTop() > 100){
//     $('#masthead').addClass('back')
//   }
//   else{
//     $('#masthead').removeClass('back')
//   };
// });
    
// });




// ======calendar=====
//this one SVG calendar function is all you need.
//************************
var d = new Date();

var Calendar = {
  themonth : d.getMonth(), // The number of the month 0-11
  theyear : d.getFullYear(), // This year
  today : [d.getFullYear(),d.getMonth(),d.getDate()], // adds today style
  selectedDate : null, // set to today in init()
  years : [], // populated with last 10 years in init()
  months : ['January','February','March','April','May','June','July','August','September','October','November','December'],

  init: function(){
    this.selectedDate = this.today
    // Populate the list of years in the month/year pulldown
    var year = this.theyear;
    for (var i=0; i<10; i++) {
      this.years.push(year--);
    }
    
    this.bindUIActions();
    this.render();
  },

  bindUIActions: function() {
    // Create Years list and add to ympicker
    for (var i=0;i<this.years.length;i++)
      $('<li>'+this.years[i]+'</li>').appendTo('.calendar-ympicker-years');
    this.selectMonth(); this.selectYear(); // Add active class to current month n year

    // Slide down year month picker
    $('.monthname').click(function(){
      $('.calendar-ympicker').css('transform','translateY(0)');
    });

    // Close year month picker without action
    $('.close').click(function(){
      $('.calendar-ympicker').css('transform','translateY(-100%)');
    });

    // Move calander to today
    $('.today').click(function(){
      Calendar.themonth = d.getMonth(); 
      Calendar.theyear = d.getFullYear();
      Calendar.selectMonth(); Calendar.selectYear();
      Calendar.selectedDate = Calendar.today;
      Calendar.render();
      $('.calendar-ympicker').css('transform','translateY(-100%)');
    });

    // Click handlers for ympicker list items
    $('.calendar-ympicker-months li').click(function(){        
      Calendar.themonth = $('.calendar-ympicker-months li').index($(this));
      Calendar.selectMonth();
      Calendar.render();
      $('.calendar-ympicker').css('transform','translateY(-100%)');
    });
    $('.calendar-ympicker-years li').click(function(){         
      Calendar.theyear = parseInt($(this).text());
      Calendar.selectYear();
      Calendar.render();
      $('.calendar-ympicker').css('transform','translateY(-100%)');
    });

    // Move the calendar pages
    $('.minusmonth').click(function(){
      Calendar.themonth += -1;
      Calendar.changeMonth();
    });
    $('.addmonth').click(function(){
      Calendar.themonth += 1;
      Calendar.changeMonth();
    });
  },

  // Adds class="active" to the selected month/year
  selectMonth : function(){
    $('.calendar-ympicker-months li').removeClass('active');
    $('.calendar-ympicker-months li:nth-child('+(this.themonth+1)+')').addClass('active');
  },
  selectYear : function(){
    $('.calendar-ympicker-years li').removeClass('active');
    $('.calendar-ympicker-years li:nth-child('+(this.years.indexOf(this.theyear)+1)+')').addClass('active');
  },

  // Makes sure that month rolls over years correctly
  changeMonth: function(){
    if(this.themonth == 12){
        this.themonth = 0;
        this.theyear++;
        this.selectYear();
      }
    else if(this.themonth == -1){
      this.themonth = 11;
      this.theyear--;
      this.selectYear();
    }
    this.selectMonth();
    this.render();
  },

  // Helper functions for time calculations
  TimeCalc : {
    firstDay : function(month,year) {
      var fday = new Date(year,month,1).getDay(); // Mon 1 ... Sat 6, Sun 0
      if (fday === 0) fday = 7;
      return fday -1; // Mon 0 ... Sat 5, Sun 6
    },
    numDays : function(month,year) {
      return new Date(year,month+1,0).getDate(); // Day 0 is the last day in the previous month
    }
  },

  render : function(){
    var days = this.TimeCalc.numDays(this.themonth, this.theyear), // get number of days in the month
      fDay = this.TimeCalc.firstDay(this.themonth, this.theyear), // find what day of the week the 1st lands on        
      daysHTML = '', i;

    $('.calendar p.monthname').text(this.months[this.themonth]+'  '+this.theyear); // add month name and year to calendar
    for (i=0; i<fDay; i++) { // place the first day of the month in the correct position
      daysHTML += '<li class="noclick">&nbsp;</li>';
    }
    // write out the days
    for (i=1; i<=days; i++) { 
      if(this.today[0] == this.selectedDate[0] && 
        this.today[1] == this.selectedDate[1] && 
        this.today[2] == this.selectedDate[2] &&
        this.today[0] == this.theyear && 
        this.today[1] == this.themonth && 
        this.today[2] == i)
        daysHTML += '<li class="active today">'+i+'</li>';
      else if(this.today[0] == this.theyear && 
        this.today[1] == this.themonth && 
        this.today[2] == i)
        daysHTML += '<li class="today">'+i+'</li>';
      else if(this.selectedDate[0] == this.theyear && 
        this.selectedDate[1] == this.themonth && 
        this.selectedDate[2] == i)
        daysHTML += '<li class="active">'+i+'</li>';
      else
        daysHTML += '<li>'+i+'</li>';

      $('.calendar-body').html(daysHTML); // Only one append call
    }
    
    // Adds active class to date when clicked
    $('.calendar-body li').click(function(){ // toggle selected dates
      if(!$(this).hasClass('noclick')){
        $('.calendar-body li').removeClass('active');
        $(this).addClass('active');
        Calendar.selectedDate = [Calendar.theyear, Calendar.themonth, $(this).text()]; // save date for reselecting
      }
    });
  }
};

Calendar.init();
// =======calendar-end======

var Days = [31,28,31,30,31,30,31,31,30,31,30,31];// index => month [0-11]
$(document).ready(function(){
    var option = '<option value="day">day</option>';
    var selectedDay="day";
    for (var i=1;i <= Days[0];i++){ //add option days
        option += '<option value="'+ i + '">' + i + '</option>';
    }
    $('#day').append(option);
    $('#day').val(selectedDay);

    var option = '<option value="month">month</option>';
    var selectedMon ="month";
    for (var i=1;i <= 12;i++){
        option += '<option value="'+ i + '">' + i + '</option>';
    }
    $('#month').append(option);
    $('#month').val(selectedMon);

    var option = '<option value="month">month</option>';
    var selectedMon ="month";
    for (var i=1;i <= 12;i++){
        option += '<option value="'+ i + '">' + i + '</option>';
    }
    $('#month2').append(option);
    $('#month2').val(selectedMon);
  
    var d = new Date();
    var option = '<option value="year">year</option>';
    selectedYear ="year";
    for (var i=1930;i <= d.getFullYear();i++){// years start i
        option += '<option value="'+ i + '">' + i + '</option>';
    }
    $('#year').append(option);
    $('#year').val(selectedYear);
});


// ======card-silder======
 $(document).ready(function(){
        $('.card_inner_slider').slick({
         autoplay: true,
    	 arrows: true,
    	 slidesToShow: 1,
    	 slidesToScroll: 1,
    // 	 dots:true,
   
          prevArrow: '<button class="slide-arrow prev-arrow"><img src="./assets/image/cel-left.png"></button>',
          nextArrow: '<button class="slide-arrow next-arrow"><img src="./assets/image/cel-right.png"></button>',
          
      });
      
        $('.prev-arrow').on('click', function() {
            $('.card_inner_slider').slick('slickPlay');
        });
        
        $('.next-arrow').on('click', function() {
            $('.card_inner_slider').slick('slickPlay');
        });
        
        
          
    });


// ======card-silder======
 $(document).ready(function(){
        $('.card-hover-slider').slick({
         autoplay: true,
    	 arrows: true,
    	 slidesToShow: 1,
    	 slidesToScroll: 1,
         
    // 	 dots:true,
   
          prevArrow: '<button class="slide-arrow prev-arrow"><img src="./assets/image/cel-left.png"></button>',
          nextArrow: '<button class="slide-arrow next-arrow"><img src="./assets/image/cel-right.png"></button>'
      });
      
        $('.prev-arrow').on('click', function() {
            $('.card-hover-slider').slick('slickPlay');
        });
        
        $('.next-arrow').on('click', function() {
            $('.card-hover-slider').slick('slickPlay');
        });
          
         
        
          
    });


// // =======banner-slider======
 $('.your-class').slick({
	 autoplay: true,
	 arrows: false,
	 slidesToShow: 1,
	 slidesToScroll: 1,
	 dots:true
});

// // =======login-slider======
 $('.circle-slide').slick({
	 autoplay: true,
	 arrows: false,
	 slidesToShow: 1,
	 slidesToScroll: 1,
	 dots:true
});


//=====banner service slider at mobile responsive====

 $('.mb-detail').slick({
	 autoplay: true,
	 arrows: false,
	 slidesToShow: 1,
	 slidesToScroll: 1,
	 dots:false
});
// ======customer-silder1======
 $(document).ready(function(){
        $('.customer-slider').slick({
            
         autoplay: true,
    	 arrows: true,
    	 slidesToShow: 2,
    	 slidesToScroll: 1,
    	 dots:true,
   
          prevArrow: '<button class="slide-arrow prev-arrow"><img src="./assets/image/top-left.png"></button>',
          nextArrow: '<button class="slide-arrow next-arrow"><img src="./assets/image/top-right.png"></button>',
           responsive: [
            {
              breakpoint:600,
              settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
                infinite: true,
                dots: true
              }
            },
            {
              breakpoint: 480,
              settings: {
                slidesToShow: 1,
                slidesToScroll: 1
              }
            }
          ]
      });
      
        $('.prev-arrow').on('click', function() {
            $('.customer-slider').slick('slickPlay');
        });
        
        $('.next-arrow').on('click', function() {
            $('.customer-slider').slick('slickPlay');
        });
          
    });

///new-custom
$(document).ready(function(){
        $('.customer-slider').slick({
          autoplay:true,
          autoplaySpeed:1500,
          slidesToShow: 2,
          slidesToScroll: 1,
        //   arrows: false,
          fade: false,
        //   dots: true,
         prevArrow: '<button class="slide-arrow prev-arrow"><img src="./assets/image/top-left.png"></button>',
          nextArrow: '<button class="slide-arrow next-arrow"><img src="./assets/image/top-right.png"></button>',
          responsive: [
            {
              breakpoint:767,
              settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
                infinite: true,
                dots: true
              }
            },
            
            {
              breakpoint: 481,
              settings: {
                slidesToShow: 1,
                slidesToScroll: 1
              }
            }
          ]
      });
      
        $('.prev-arrow').on('click', function() {
            $('.customer-slider').slick('slickPlay');
        });
        
        $('.next-arrow').on('click', function() {
            $('.customer-slider').slick('slickPlay');
        });
          
    });
	
// ======feature-sec-silder1======
 $(document).ready(function(){
        $('.feature-top-slide').slick({
          autoplay:true,
          autoplaySpeed:1500,
          slidesToShow: 4,
          slidesToScroll: 1,
        //   arrows: false,
          fade: false,
        //   dots: true,
          prevArrow: '<button class="slide-arrow prev-arrow"><img src="./assets/image/top-left.png"></button>',
          nextArrow: '<button class="slide-arrow next-arrow"><img src="./assets/image/top-right.png"></button>',
          responsive: [
            {
              breakpoint:768,
              settings: {
                slidesToShow: 2,
                slidesToScroll: 2,
                infinite: true,
                dots: true
              }
            },
            
            {
              breakpoint: 481,
              settings: {
                slidesToShow: 1,
                slidesToScroll: 1
              }
            }
          ]
      });
      
        $('.prev-arrow').on('click', function() {
            $('.feature-top-slide').slick('slickPlay');
        });
        
        $('.next-arrow').on('click', function() {
            $('.feature-top-slide').slick('slickPlay');
        });
          
    });

// ======feature-sec-silder2======
 $(document).ready(function(){
        $('.feature-btm-slide').slick({
            
          autoplay:true,
          autoplaySpeed:1500,
          slidesToShow: 4,
          slidesToScroll: 1,
        //   arrows: false,
          fade: false,
        //   dots: true,
          
        //   dots: true,
          infinite: true,
          speed: 500,
          
          prevArrow: '<button class="slide-arrow prev-arrow"><img src="./assets/image/right-botm.png"></button>',
          nextArrow: '<button class="slide-arrow next-arrow"><img src="./assets/image/left-btm.png"></button>',
          responsive: [
            {
              breakpoint:768,
              settings: {
                slidesToShow: 2,
                slidesToScroll: 2,
                infinite: true,
                dots: true
              }
            },
            
            {
              breakpoint: 481,
              settings: {
                slidesToShow: 1,
                slidesToScroll: 1
              }
            }
          ]
      });
      
        $('.prev-arrow').on('click', function() {
            $('.feature-btm-slide').slick('slickPlay');
        });
        
        $('.next-arrow').on('click', function() {
            $('.feature-btm-slide').slick('slickPlay');
        });
          
    });


// =======language=======
//$(function(){
//    $('.selectpicker').selectpicker();
//});

// ===== Scroll to Top ==== 
$(window).scroll(function() {
    if ($(this).scrollTop() >= 50) {        // If page is scrolled more than 50px
        $('#return-to-top').fadeIn(200);    // Fade in the arrow
    } else {
        $('#return-to-top').fadeOut(200);   // Else fade out the arrow
    }
});
$('#return-to-top').click(function() {      // When arrow is clicked
    $('body,html').animate({
        scrollTop : 0                       // Scroll to top of body
    }, 500);
});

//====Mobile responsive Side menu====

function openNav() {
    document.getElementById("mySidenav").style.width = "85%";
}
function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
}


//====special-team-sec====

$(document).ready(function(){
        $('.team-slider').slick({
          autoplay:true,
          autoplaySpeed:1500,
          slidesToShow: 1,
          slidesToScroll: 1,
        //   arrows: false,
          fade: false,
        //   dots: true,
          responsive: [
            {
              breakpoint:767,
              settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
                infinite: true,
                dots: true
              }
            },
            
            {
              breakpoint: 481,
              settings: {
                slidesToShow: 1,
                slidesToScroll: 1
              }
            }
          ]
      });
      
        $('.prev-arrow').on('click', function() {
            $('.feature-top-slide').slick('slickPlay');
        });
        
        $('.next-arrow').on('click', function() {
            $('.feature-top-slide').slick('slickPlay');
        });
          
    });
