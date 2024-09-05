$(document).ready(function () {

    var current_fs, next_fs, previous_fs; //fieldsets
    var opacity;

    $(".next").click(function () {

        current_fs = $(this).parent();
        next_fs = $(this).parent().next();

        //Add Class Active
        $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");

        //show the next fieldset
        next_fs.show();
        //hide the current fieldset with style
        current_fs.animate({ opacity: 0 }, {
            step: function (now) {
                // for making fielset appear animation
                opacity = 1 - now;

                current_fs.css({
                    'display': 'none',
                    'position': 'relative'
                });
                next_fs.css({ 'opacity': opacity });
            },
            duration: 600
        });
    });

    $(".previous").click(function () {

        current_fs = $(this).parent();
        previous_fs = $(this).parent().prev();

        //Remove class active
        $("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");

        //show the previous fieldset
        previous_fs.show();

        //hide the current fieldset with style
        current_fs.animate({ opacity: 0 }, {
            step: function (now) {
                // for making fielset appear animation
                opacity = 1 - now;

                current_fs.css({
                    'display': 'none',
                    'position': 'relative'
                });
                previous_fs.css({ 'opacity': opacity });
            },
            duration: 600
        });
    });

    $('.radio-group .radio').click(function () {
        $(this).parent().find('.radio').removeClass('selected');
        $(this).addClass('selected');
    });

    $(".submit").click(function () {
        return false;
    })

});

    var TxtType = function(el, toRotate, period) {
        this.toRotate = toRotate;
        this.el = el;
        this.loopNum = 0;
        this.period = parseInt(period, 10) || 2000;
        this.txt = '';
        this.tick();
        this.isDeleting = false;
    };

    TxtType.prototype.tick = function() {
        var i = this.loopNum % this.toRotate.length;
        var fullTxt = this.toRotate[i];

        if (this.isDeleting) {
            this.txt = fullTxt.substring(0, this.txt.length - 1);
        } else {
            this.txt = fullTxt.substring(0, this.txt.length + 1);
        }

        this.el.innerHTML = '<span class="wrap">' + this.txt + '</span>';

        var that = this;
        var delta = 200 - Math.random() * 100;

        if (this.isDeleting) {
            delta /= 2;
        }

        if (!this.isDeleting && this.txt === fullTxt) {
            delta = this.period;
            this.isDeleting = true;
        } else if (this.isDeleting && this.txt === '') {
            this.isDeleting = false;
            this.loopNum++;
            delta = 500;
        }

        setTimeout(function() {
            that.tick();
        }, delta);
    };

    window.onload = function() {
        var elements = document.getElementsByClassName('typewrite');
        for (var i = 0; i < elements.length; i++) {
            var toRotate = elements[i].getAttribute('data-type');
            var period = elements[i].getAttribute('data-period');
            if (toRotate) {
                new TxtType(elements[i], JSON.parse(toRotate), period);
            }
        }
        // INJECT CSS
        var css = document.createElement("style");
        css.type = "text/css";
        css.innerHTML = ".typewrite > .wrap { border-right: 0.08em solid #fff}";
        document.body.appendChild(css);
    };

    // ===================================JS for form validation=============================
    function getSidFromQueryString() {
        var urlParams = new URLSearchParams(window.location.search);
        return urlParams.get('sid');
    }

    function EnrollSurvey() {
      var fullName = document.getElementById('txtFullname').value
      var email = document.getElementById('txtEmail').value
      var sid = getSidFromQueryString()

      // Perform validation
      if (fullName.trim() === '') {
        alert('Please enter your full name.')
        return // Stop execution if full name is blank
      }

      // Regular expression for email validation
      var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/

      if (email.trim() === '') {
        alert('Please enter your email.')
        return // Stop execution if email is blank
      } else if (!emailPattern.test(email)) {
        alert('Please enter a valid email address.')
        return // Stop execution if email format is invalid
      }

      // Data to be sent via AJAX
      var data = {
        fullName: fullName, // as table supports integer change the name and email to static integer values for testing
        email: email,
        sid: sid,
      }

      // Send data to PHP script using AJAX
      $.ajax({
        url: 'enrollsurvey.php?sid=' + sid,
        type: 'POST',
        data: data,
        success: function(response) {
            var responseData = JSON.parse(response);
            if (responseData.success) {
                var insertedId = responseData.inserted_id;
                $("#hdnMainEnrollId").val(insertedId);  // Storing ID in hidden input (if needed elsewhere)
    
                // Now update the anchor's href attribute
                $('#viewInvoiceLink').attr('href', 'invoice.php?srid=' + insertedId);
    
                console.log("Inserted ID: " + insertedId);
                // Optional: Move to the next step
                showNextStep();
            } else {
                // Handle failure
                console.error(responseData.message);
            }
        },
        error: function(xhr, status, error) {
            // Handle error
            console.error(xhr.responseText);
        }
    });
    }

    function showNextStep(stepname) {
      // Hide the current step
      var currentStep = document.querySelector('fieldset[name="step1"]')
      currentStep.style.display = 'none'

      // Show the next step
      var nextStep = document.querySelector('fieldset[name="step2"]')
      nextStep.style.display = 'block'

      // Add 'active' class to the corresponding progress bar item
      var currentProgressBarItem = document.querySelector('#step1')
      var nextProgressBarItem = document.querySelector('#step2')

      // Add 'active' class to next progress bar item
      nextProgressBarItem.classList.add('active')
    }

    document.addEventListener('DOMContentLoaded', function () {
      var line1 = document.querySelector('.line1')
      var line2 = document.querySelector('.line2')
      var text1 = line1.textContent.trim()
      var text2 = line2.textContent.trim()

      function typeLine1() {
        line1.textContent = ''
        var index = 0
        var typingInterval = setInterval(function () {
          line1.textContent += text1[index++]
          if (index === text1.length) {
            clearInterval(typingInterval)
            line2.classList.remove('hidden')
            typeLine2()
          }
        }, 100)
      }

      function typeLine2() {
        line2.textContent = ''
        var index = 0
        var typingInterval = setInterval(function () {
          line2.textContent += text2[index++]
          if (index === text2.length) {
            clearInterval(typingInterval)
            setTimeout(function () {
              line1.textContent = ''
              line2.textContent = ''
              line2.classList.add('hidden')
              typeLine1()
            }, 1000) // Delay before restarting typing
          }
        }, 100)
      }

      typeLine1()
    })

    // Storing static question and answer to survey answers table
    $(document).ready(function() {
      $(".next").click(function() {
          var currentFieldset = $(this).closest('fieldset');
          var srId = $("#hdnMainEnrollId").val();
          var quesIds = [];
          var answers = [];
  
          // Collect all question IDs from hidden inputs
          currentFieldset.find("input[type='hidden'][name^='Qid']").each(function() {
              quesIds.push($(this).val());
          });
  
          // Check if the fieldset contains any textarea for answers
          if (currentFieldset.find("textarea.survey-answer").length > 0) {
              // Collect values from textareas
              currentFieldset.find("textarea.survey-answer").each(function() {
                  answers.push($(this).val());
              });
          } else {
              // Collect values from checked radio buttons
              currentFieldset.find("input[type='radio']:checked").each(function() {
                  answers.push($(this).val());
              });
          }
  
          console.log("SR ID:", srId); // Debug: Check SR ID
          console.log("Question IDs:", quesIds); // Debug: Check Question IDs
          console.log("Answers:", answers); // Debug: Check Answers
  
          $.ajax({
              url: 'saveSurveyData.php',
              type: 'POST',
              data: {
                  SR_Id: srId,
                  QuesIds: quesIds,
                  Answers: answers
              },
              success: function(response) {
                  console.log('Data saved: ' + response);
              },
              error: function(xhr, status, error) {
                  console.error('Error saving data: ' + error);
              }
          });
      });
  });
  