Collection={
	artists:[],
	loaded:false,
	loading:false,
	loadedListeners:[],
	load:function(ready){
		if(ready){
			Collection.loadedListeners.push(ready);
		}
		if(!Collection.loading){
			Collection.loading=true;
			$.ajax({
				url: OC.linkTo('media','ajax/api.php')+'?action=get_collection',
				dataType: 'json',
				success: function(collection){
					Collection.artists=collection;
					
					//set the album and artist fieds for the songs
					for(var i=0;i<collection.length;i++){
						var artist=collection[i];
						for(var j=0;j<artist.albums.length;j++){
							var album=artist.albums[j]
							for(var w=0;w<album.songs.length;w++){
								album.songs[w].album_name=album.album_name;
								album.songs[w].artist_name=artist.artist_name;
							}
						}
					}
					
					Collection.loaded=true;
					Collection.loading=false;
					for(var i=0;i<Collection.loadedListeners.length;i++){
						Collection.loadedListeners[i]();
					}
					
				}
			});
		}
	},
	display:function(){
		if(Collection.parent){
			Collection.parent.show();
		}
		if(!Collection.loaded){
			Collection.load(Collection.display)
		}else{
			if(Collection.parent){
				Collection.parent.children('li.artist').remove();
				var template=Collection.parent.children('li.template');
				for(var i=0;i<Collection.artists.length;i++){
					var artist=Collection.artists[i];
					var li=template.clone();
					li.data('artist',artist);
					li.removeClass('template');
					li.addClass('artist');
					li.data('type','artist');
					li.children('span').text(artist.artist_name);
					Collection.addButtons(li);
					Collection.parent.append(li);
				}
			}
		}
	},
	parent:null,
	hide:function(){
		if(Collection.parent){
			Collection.parent.hide();
		}
	},
	showAlbums:function(artistLi){
		$('ul.albums').parent().removeClass('active');
		$('ul.albums').remove();
		var artist=artistLi.data('artist');
		if(artist){
			var template=Collection.parent.children('li.template');
			var ul=$('<ul class="albums"></ul>');
			for(var i=0;i<artist.albums.length;i++){
				var li=template.clone();
				var album=artist.albums[i];
				li.removeClass('template');
				li.addClass('album');
				li.data('album',album);
				li.data('type','album');
				li.children('span').text(album.album_name);
				Collection.addButtons(li);
				ul.append(li);
			}
			artistLi.append(ul);
		}
	},
	showSongs:function(albumLi){
		$('ul.songs').parent().removeClass('active');
		$('ul.songs').remove();
		var album=albumLi.data('album');
		var template=Collection.parent.children('li.template');
		var ul=$('<ul class="songs"></ul>');
		for(var i=0;i<album.songs.length;i++){
			var li=template.clone();
			var song=album.songs[i];
			li.removeClass('template');
			li.addClass('song');
			li.data('song',song);
			li.data('type','song');
			li.children('span').text(song.song_name);
			Collection.addButtons(li);
			ul.append(li);
		}
		albumLi.append(ul);
	},
	registerPlay:function(){
		var item=PlayList.items[PlayList.current];
		for(var i=0;i<Collection.artists.length;i++){
			var artist=Collection.artists[i];
			for(var j=0;j<artist.albums.length;j++){
				var album=artist.albums[j]
				for(var w=0;w<album.songs.length;w++){
					var song=album.songs[w];
					if(song.song_name==item.name && song.artist_name==item.artist && song.album_name==item.album){
						song.song_playcount++;
					}
				}
			}
		}
	},
	addButtons:function(parent){
		parent.children('button.add').click(function(){
			var type=$(this).parent().data('type');
			PlayList.add($(this).parent().data(type));
		});
		parent.children('button.play').click(function(){
			var type=$(this).parent().data('type');
			var oldSize=PlayList.items.length;
			PlayList.add($(this).parent().data(type));
			PlayList.play(oldSize);
		});
	}
}

$(document).ready(function(){
	Collection.parent=$('#collection');
	Collection.load();
	$('#collection li.artist>span').live('click',function(){
		$(this).parent().toggleClass('active');
		Collection.showAlbums($(this).parent());
	});
	$('#collection li.album>span').live('click',function(){
		$(this).parent().toggleClass('active');
		Collection.showSongs($(this).parent());
	});
});
