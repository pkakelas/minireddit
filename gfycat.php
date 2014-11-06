<?php
    function convertToGfy( $url ) {
        $curl = curl_init( 'http://upload.gfycat.com/transcode?fetchUrl=' . $url );
        ob_start();
        curl_exec( $curl );
        $result = json_decode( ob_get_clean() );
        return $result->gfyname;
    }

    function checkIfKnown( $url ) {
        $curl = curl_init( 'http://gfycat.com/cajax/checkUrl/' . $url );
        ob_start();
        curl_exec( $curl );
        $result = json_decode( ob_get_clean() );
        if ( $result->urlKnown ) {
            return $result->gfyname;
        }
        return false;
    }

    if ( isset( $_GET[ 'url' ] ) ) {
        $url = $_GET[ 'url' ];
        $exists = checkIfKnown( $url );
        if ( $exists != false ) {
            echo $exists;
        }
        echo convertToGfy( $url );
    }
    else { 
        echo false; 
    }
?>
