jQuery(document).ready(function ($) {
  $(document).trigger("click");
  $("#open-player").click(function () {
    var player = $(".radio-player");
    player.show();
    $(".button_action_radio").trigger('click');
    sessionStorage.setItem("play", true);
  });

  function check_status_player() {
    var status = sessionStorage.getItem("play");
    var player = $(".radio-player");
    var closedUser = sessionStorage.getItem("closeduser");
    if (status === "true" || !closedUser) {
      player.show();
    } else {
      player.hide();
    }
  }

  check_status_player();

  function play() {
    var audio = document.getElementById("audio");
    sessionStorage.setItem("played", true);
    audio.play();
  }

  function stop() {
    var audio = document.getElementById("audio");
    sessionStorage.setItem("played", false);
    audio.pause();
  }

  $(".button_action_radio").click(function () {
    var status = $(this).hasClass("play");
    if (status) {
      stop();
      $(this).removeClass("play");
      $(".radio-player").removeClass("player-active");
      $(".title-radio").html("Ouça nossa rádio ao vivo!");
      $("#appDownload").show();
    } else {
      $(this).addClass("play");
      play();
      $(".radio-player").addClass("player-active");
      $("#appDownload").hide();
      fetch(
        "https://s05.maxcast.com.br/api/status/estacaodemocracia/current.json",
        {
          method: "get",
          mode: "cors",
        }
      )
        .then((resp) => resp.json())
        .then(function (response) {
          $(".title-radio").html(response.playing.current);
        })
        .catch(function (error) {
          console.error(error);
        });
    }
  });

  $(".close-player").click(function () {
    var player = $(".radio-player");
    sessionStorage.setItem("play", false);
    stop();
    player.hide("slow");
    sessionStorage.setItem("closeduser", true);
  });
  if (sessionStorage.getItem("played") == "true") {
    $(".button_action_radio").trigger("click");
  }
});