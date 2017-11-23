<?php ob_start();?>
{
    "user": {
        "title": "Mr",
        "firstName": "Callum",
        "lastNmae": "Coombes",
		"lastSeen": {
            "time": "2017-11-19 17:38:27",
            "loc": {
            	"lat": "52.6309",
            	"lng": "1.2974"
        	}
        }
    }
}
<?php $json_string = ob_get_clean(); ?>
<?php $template->_set('json',$json_string); ?>