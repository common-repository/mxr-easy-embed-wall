( function( $ ) {

var id = mixer_wall_vars.id;
var target = '.mixer-wall-'+id+' #stream-container ul';
var limit = 5;
var showDefault = '';
var theme = mixer_wall_vars.theme;
if (mixer_wall_vars.limit !== '') {
    limit = mixer_wall_vars.limit;
    }
if (mixer_wall_vars.mixerGames != '') {
     getGameName(mixer_wall_vars.mixerGames);
} else if (mixer_wall_vars.mixerNames != '') {
    getChannels(mixer_wall_vars.mixerNames);
} else if (mixer_wall_vars.mixerTeam != '') {
    getTeamId(mixer_wall_vars.mixerTeam)
}

//---- ******* END Click Options ******* ----//

//---- ******* Teams ******* ----//

function getTeamId(team) {
$.ajax({
        url: 'https://mixer.com/api/v1/teams/'+team,
        type: 'GET',
        success: function(data) {
            teamId = data.id;
        },
        error: function(data) {
        },
        complete: function(data) {
            getTeam(teamId);
        }
    });
}

function getTeam(teamId) {
    $.ajax({
        url: 'https://mixer.com/api/v1/teams/'+teamId+'/users?where=teamMembership.accepted:eq:1,channel.online:eq:1',
        type: 'GET',
        success: function(data) {
            appendStreams(data);
        },
        error: function(data) {
        },
        complete: function(data) {
        }
    });
}

//---- ******* END Teams ******* ----//

//---- ******* Channels ******* ----//

function getChannels(names){

$.ajax({
    url: 'https://mixer.com/api/v1/channels?order=viewersCurrent:DESC&where=token:in:'+names,
    type: 'GET',
    success: function(data) {
        appendStreams(data)
    },
    error: function(data) {
      console.log('[Easy Embed Mixer] - Failed to retrieve Channels')
    },
    complete: function(data) {
      console.log('[Easy Embed Mixer] - Success - retrieved Channels')
    }
});

}

//---- ******* END Channels ******* ----//

//---- ******* Game ******* ----//

function getGameName(name) {
    $.ajax({
        url: 'https://mixer.com/api/v1/types?query='+name,
        type: 'GET', 
        headers: {
           'Client-ID': 'c9y13nevu8fzazuq2ty6zdqz9f7xlem',
           'Accept': 'application/vnd.twitchtv.v5+json'
        },
        success: function(data) {
            console.log('[Easy Embed Mixer] - Retrieving Channels - Success -' + name)
            id = data[0].id;
        },
        error: function(data) {
            console.log('[Easy Embed Mixer] - Failed to retrieve Game ID')
        },
        complete: function(data) {
          getGameStreams(id);
        }
    });
}

function getGameStreams(id) {
    url = 'https://mixer.com/api/v1/channels?order=viewersCurrent:DESC&where=typeId:eq:'+id;
    $.ajax({
        url: url,
        type: 'GET',
        success: function(data) {
            console.log(data)
            if (data) {
                appendStreams(data);
            } else {                
            }
        },
        error: function(data) {
            console.log('[Easy Embed Mixer] - Failed to retreieve Game Streams')
        }
    });
}

//---- ******* End Game ******* ----//

//---- ******* Append Streams ******* ----//

function appendStreams(fullArray) {
    // If the number of streams returned is less than the defined limit & offline is disabled, change limit.
    var fullArrayLength = fullArray.length;
    if (fullArrayLength > 9) {
        fullArrayLength = 9;
    }
    if (fullArray.length < limit) {
        limit = fullArray.length;
    } 
    for (var i=0;i<limit;i++) {
        console.log(fullArray[i])
        if (fullArray[i].user) {
            var display_name = fullArray[i].user.username;
        } else {
            var display_name = fullArray[i].username;
        }   
         if (fullArray[i].thumbnail && fullArray[i].thumbnail !== null) {
            var preview = fullArray[i].thumbnail.url;
        } else if (fullArray[i].bannerUrl && fullArray[i].bannerUrl !== null) {
            var preview = fullArray[i].bannerUrl;     
        } else if (fullArray[i].user && fullArray[i].user.avatarUrl !== null) {
            var preview = fullArray[i].user.avatarUrl;
        } else if (fullArray[i].type && fullArray[i].type.backgroundUrl !== null) {
            var preview = fullArray[i].type.backgroundUrl;
        } else if (fullArray[i].avatarUrl && fullArray[i].avatarUrl !== null) {
            var preview = fullArray[i].avatarUrl;
        }
        if (fullArray[i].channel && fullArray[i].channel.viewersCurrent !== '') {
            var viewers = fullArray[i].channel.viewersCurrent;
        } else {
            var viewers = fullArray[i].viewersCurrent;
        }
        var channel_name = fullArray[i].name;
        var url = 'https://www.mixer.com/'+display_name;
        var html = '<li class="stream" data-viewers="'+viewers+'"><a target="_blank" href="'+url+'" title="Watch '+display_name+' Now!" data-channel-name='+display_name+'>';
        html +=  '<div class="twitch-image" style="background-image:url('+preview+')"><div class="twitch-image-overlay"><img src="'+mixer_wall_vars.play+'"></div></div>';
        html += '<div class="twitch-info"><div class="twitch-title">'+display_name+'</div><div class="twitch-meta"><span class="twitch-name">'+display_name+'</span> streaming for <span class="twitch-viewers">'+viewers+ ' viewers</span></div>';
        html += '</div></a>';
        html += '<span class="online-indicator online-indicator--online"></span>';
        html += '</li>';
      $(html).appendTo(target)
      $('#mixer-module.mixer-wall').removeClass('loading');
      $("#mixer-module.mixer-wall .offline-slide").remove()
    }
    
    if (fullArray.length == 0) {
      $('#mixer-module.mixer-wall').removeClass('loading');
      $("#mixer-module.mixer-wall .offline-slide").show()
    }    
        
    $(target).children('li').sort(function(a, b) {
            return -a.dataset.viewers - -b.dataset.viewers;
        }).prependTo(target);
}
    
//---- ******* END Append Streams ******* ----//

	var embedStream = function(name,parentId){
      if (theme == 'dark-theme') {
        theme = 'dark';
      } else {
        theme = 'light';
      }
	  $('#mixer-embed-'+parentId).empty()
      $('#mixer-embed-'+parentId).addClass('active')
      $('#mixer-embed-'+parentId).append('<iframe src="https://mixer.com/embed/player/'+name+'" style="width:100%; height:100%"></iframe>')
	}
    

	$(document).on('click', '.mixer-wall #stream-container ul li a', function(e){
        e.preventDefault()    
        parentId = $(this).parents('#mixer-module').data('id');  	  
	    name = $(this).data('channel-name')
	    embedStream(name,parentId)
        var offset = $('#mixer-embed-'+parentId).offset().top;
        $('html, body').animate({
            scrollTop: offset - 100
        },1000);
	})

} )( jQuery );