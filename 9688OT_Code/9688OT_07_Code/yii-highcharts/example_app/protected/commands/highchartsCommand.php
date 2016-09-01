<?php

class highchartsCommand extends CConsoleCommand
{
    public function actionGenerate($file, $scale=False, $width=False, $format='pdf') { 
        $PHANTOM_JS = exec('which phantomjs');
        $SCRIPT ="\"".Yii::app()->basePath.'/../js/highcharts-phantomjs/highcharts-convert.js'."\"";
        

        echo "Generating chart...\n";

        $cmd = $PHANTOM_JS." ".$SCRIPT;
        
        if ($scale) {
            $cmd .= " -scale ".$scale;
        }

        if($width) {
            $cmd .= " -width ".$width;
        }

        $cmd .= ' -infile '.$file;
        $cmd .= ' -outfile file.'.$format;

        echo exec($cmd);
    }

    protected function createOptionsFile() {
        $sql = "SELECT * FROM {{monster}}";
        
        $connection = Yii::app()->db;
        $users=$connection->createCommand($sql)->queryAll();
        echo CJSON::encode($users);
        return 'filename.json';
    }
}

?>
