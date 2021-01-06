var myIndex = 0;
carousel();
function carousel() {
	var i;
	var x = document.getElementsByClassName("mySlides");
	for (i = 0; i < x.length; i++) {
		x[i].style.display = "none";
	}
	myIndex++;
	if (myIndex > x.length) {
		myIndex = 1;
	}
	x[myIndex - 1].style.display = "block";
	setTimeout(carousel, 2000); // Change image every 2 seconds
}
const words = ["Techinical Events", "Outdoors & Adventure", "DJ & Party"];
let i = 0;
let timer;

function typingEffect() {
	let word = words[i].split("");
	var loopTyping = function () {
		if (word.length > 0) {
			document.getElementById("word").innerHTML += word.shift();
		} else {
			deletingEffect();
			return false;
		}
		timer = setTimeout(loopTyping, 500);
	};
	loopTyping();
}

function deletingEffect() {
	let word = words[i].split("");
	var loopDeleting = function () {
		if (word.length > 0) {
			word.pop();
			document.getElementById("word").innerHTML = word.join("");
		} else {
			if (words.length > i + 1) {
				i++;
			} else {
				i = 0;
			}
			typingEffect();
			return false;
		}
		timer = setTimeout(loopDeleting, 200);
	};
	loopDeleting();
}

$(".button[data-target]").click(function() {
	$("#" + this.dataset.target).toggleClass("-open")
	var eventname = $(this).data('name');
	 $('#nameHolder').html( eventname );
	var location = $(this).data('location');
	$('#locationHolder').html( location );
	var startdate = $(this).data('startdate');
	$('#startdateHolder').html( startdate );
	var enddate = $(this).data('enddate');
	$('#enddateHolder').html( enddate);
	var fee = $(this).data('fee');
	$('#feeHolder').html( fee );
	var image = '<img class="img-card" src="dashboard/upload/' + $(this).data('image')+'" />';
	$('#imageHolder').html( image );
	var button = '<a style="text-decoration: none;" href="register.php?id=' + $(this).data('id') + '"><button type="button" style="background-color: #000; color:white; text-decoration: none; padding: 5px 20px;">Register</a> </button>'
	$('#buttonHolder').html( button );
  })
  
  $(".modal").click(function(e) {
	if (e.target === this) {
	  $(this).toggleClass("-open")
	}
  })
  
typingEffect();