function getNewFeed(){
      var feedid = $('.feeds .feed:first').attr('id');
      var feedid = feedid.match(/^feed-(\d+)$/);

      if (feedid){
        $.ajax({
            type: 'GET',
            url: '/ajax/refresh',
            context: $("#ajax-information"),
            data: { f: feedid[1] },
            success: function(data) {

                $(this).html(data);

                var feedstatus = $('.ajax-status').attr('id');
                if (feedstatus == 'none') {
                    $(this).hide();     
                };

                if (feedstatus == 'true') {
                    $(this).fadeIn().html(data);
                    $('#ajax-information a').click(function(e) {
                        //I commented the following line because (as i understand)    
                        //getNewFeed() makes the ajax call
                        $('.feeds').fadeIn().load('/ .feeds');
                        $('#ajax-information').fadeOut();
                        e.preventDefault();
                    });
                };
            }
        });
    }
}

jQuery(document).ready(function(){
     setInterval(function() {
        getNewFeed();            
     }, 7000);       
});