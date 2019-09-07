<!DOCTYPE html>

<!-- pass url parameters to javascript variables -->
<script>
    var visMode = "aframe";
</script>
<?php

    $srcDir = "data";
    if (isset($_GET["srcDir"])) {
        $srcDir = $_GET["srcDir"];
    }

	$setupUrl = "setups/default.js";
	if (isset($_GET["setup"])) {
		$setupUrl = "setups/" . $_GET["setup"] . ".js";
	}

	$modelUrl = "data/myapp/model";
	if (isset($_GET["model"])) {
		$modelUrl = $srcDir . "/" . $_GET["model"] ."/model";
	}

    $metaDataJsonUrl = $modelUrl . "/metaData.json";

    if (isset($_GET["aframe"]) && $_GET["aframe"] == 'true') {
        $loadFramework = "<script src=\"node_modules/aframe/dist/aframe-v0.9.1.min.js\"></script>";
        $loadVisualizationSpecificScripts = <<<'EOT'
        <script src="node_modules/aframe/dist/aframe-v0.9.1.min.js"></script>
        <script type="text/javascript" src="scripts/AframeCanvasManipulator.js"></script>
        <script type="text/javascript" src="scripts/AframeActionController.js"></script>
	    <script type="text/javascript" src="scripts/RelationConnector/AframeRelationConnectorController.js"></script>
	    <script type="text/javascript" src="scripts/CanvasHover/AframeCanvasHoverController.js"></script>
        <script type="text/javascript" src="scripts/camera-beta.js"></script>
EOT;
        $canvasId = "aframe-canvas";
        $visMode = "aframe";
        $canvas = <<<EOT
        <script>
            $(function(){
                $("#canvas").load(encodeURI("$modelUrl" + "/model.html"));
            });
            var globalCamera;
       </script>
EOT;

    } else {
        $multipartX3dUrl = $modelUrl . "/multiPart.x3d";
        $multipartJsonUrl = $modelUrl . "/multiPart.json";
        $loadVisualizationSpecificScripts = <<<'EOT'
        	<!--x3dom-->
        <script type="text/javascript" src="node_modules/x3dom/x3dom.js"></script>
        <link rel="stylesheet" href="node_modules/x3dom/x3dom.css" type="text/css"/>
        <script type="text/javascript" src="scripts/CanvasManipulator.js"></script>
        <script type="text/javascript" src="scripts/ActionController.js"></script>
	    <script type="text/javascript" src="scripts/RelationConnector/RelationConnectorController.js"></script>
	    <script type="text/javascript" src="scripts/CanvasHover/CanvasHoverController.js"></script>
EOT;
        $canvasId = "x3dom-x3dElement-canvas";
        $visMode = "x3dom";

        $canvas = <<<EOT
        <x3d id="x3dElement" showConsole="true">
			<scene id="scene">
								
				<Transform id="addedElements"></Transform>
				
				<MultiPart id="multiPart" mapDEFToID="true" url="$multipartX3dUrl" urlIDMap="$multipartJsonUrl"></MultiPart>							

			</scene>
		</x3d>
EOT;

    }



?>
<script type="text/javascript">
    var modelUrl		 = "<?php echo $modelUrl; ?>";

    var multipartX3dUrl  = "<?php echo $multipartX3dUrl; ?>";
    var multipartJsonUrl = "<?php echo $multipartJsonUrl; ?>";
    var metaDataJsonUrl  = "<?php echo $metaDataJsonUrl; ?>";

    var canvasId = "<?php echo $canvasId; ?>";
    var visMode = "<?php echo $visMode; ?>";
</script>
<html>
	<title>Getaviz</title>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <link rel="icon" type="image/vnd.microsoft.icon" href="favicon.ico">
	
    <!--Main-->
    <script type="text/javascript" src="node_modules/jquery/dist/jquery.min.js"></script>
    <script type="text/javascript" src="node_modules/typeahead.js/dist/typeahead.bundle.min.js"></script>    
    <script type="text/javascript" src="node_modules/handlebars/dist/handlebars.min.js"></script>

	<!--jqwidgets-->	
    <script type="text/javascript" src="node_modules/jqwidgets-scripts/jqwidgets/jqxcore.js"></script>
    <script type="text/javascript" src="node_modules/jqwidgets-scripts/jqwidgets/jqxdata.js"></script>
    <script type="text/javascript" src="node_modules/jqwidgets-scripts/jqwidgets/jqxbuttons.js"></script>
    <script type="text/javascript" src="node_modules/jqwidgets-scripts/jqwidgets/jqxmenu.js"></script>
    <script type="text/javascript" src="node_modules/jqwidgets-scripts/jqwidgets/jqxsplitter.js"></script>
    <script type="text/javascript" src="node_modules/jqwidgets-scripts/jqwidgets/jqxscrollbar.js"></script>
    <script type="text/javascript" src="node_modules/jqwidgets-scripts/jqwidgets/jqxpanel.js"></script>
    <script type="text/javascript" src="node_modules/jqwidgets-scripts/jqwidgets/jqxcheckbox.js"></script>
    <script type="text/javascript" src="node_modules/jqwidgets-scripts/jqwidgets/jqxradiobutton.js"></script>
    <script type="text/javascript" src="node_modules/jqwidgets-scripts/jqwidgets/jqxexpander.js"></script>
    <script type="text/javascript" src="node_modules/jqwidgets-scripts/jqwidgets/jqxinput.js"></script>
    <script type="text/javascript" src="node_modules/jqwidgets-scripts/jqwidgets/jqxnavigationbar.js"></script>
    <script type="text/javascript" src="node_modules/jqwidgets-scripts/jqwidgets/jqxwindow.js"></script>
    <script type="text/javascript" src="node_modules/jqwidgets-scripts/jqwidgets/jqxnotification.js"></script>
    <script type="text/javascript" src="node_modules/jqwidgets-scripts/jqwidgets/jqxtextarea.js"></script>
    <script type="text/javascript" src="node_modules/jqwidgets-scripts/jqwidgets/jqxswitchbutton.js"></script>
    <script type="text/javascript" src="node_modules/jqwidgets-scripts/jqwidgets/jqxprogressbar.js"></script>
    <script type="text/javascript" src="node_modules/jqwidgets-scripts/jqwidgets/jqxcombobox.js"></script>
    <script type="text/javascript" src="node_modules/jqwidgets-scripts/jqwidgets/jqxlistbox.js"></script>
    <script type="text/javascript" src="node_modules/jqwidgets-scripts/jqwidgets/jqxdropdownlist.js"></script>
    <script type="text/javascript" src="node_modules/jqwidgets-scripts/jqwidgets/jqxslider.js"></script>
    <script type="text/javascript" src="node_modules/jqwidgets-scripts/jqwidgets/jqxnumberinput.js"></script>
    <script type="text/javascript" src="node_modules/jqwidgets-scripts/jqwidgets/jqxform.js"></script>
    <script type="text/javascript" src="node_modules/jqwidgets-scripts/jqwidgets/jqxvalidator.js"></script>
	
    <link rel="stylesheet" href="node_modules/jqwidgets-scripts/jqwidgets/styles/jqx.base.css" type="text/css" />
    <link rel="stylesheet" href="node_modules/jqwidgets-scripts/jqwidgets/styles/jqx.metro.css" type="text/css" />
    <!-- ztree -->
    <script type="text/javascript" src="node_modules/@ztree/ztree_v3/js/jquery.ztree.core.min.js"></script>
    <script type="text/javascript" src="node_modules/@ztree/ztree_v3/js/jquery.ztree.exhide.min.js"></script>
    <script type="text/javascript" src="node_modules/@ztree/ztree_v3/js/jquery.ztree.excheck.min.js"></script>
    <link rel="stylesheet" href="node_modules/@ztree/ztree_v3/css/metroStyle/metroStyle.css" type="text/css">
    <link rel="stylesheet" href="scripts/PackageExplorer/zt.css" type="text/css">
	
	<script type="text/javascript" src="scripts/CanvasFilter/CanvasFilterController.js"></script>
	<script type="text/javascript" src="scripts/CanvasMark/CanvasMarkController.js"></script>
	<script type="text/javascript" src="scripts/CanvasFlyTo/CanvasFlyToController.js"></script>
	<script type="text/javascript" src="scripts/CanvasSelect/CanvasSelectController.js"></script>
	<script type="text/javascript" src="scripts/CanvasResetView/CanvasResetViewController.js"></script>	
	<script type="text/javascript" src="scripts/CanvasGrid/CanvasGridController.js"></script>	
	<script type="text/javascript" src="scripts/RelationTransparency/RelationTransparencyController.js"></script>
	<script type="text/javascript" src="scripts/RelationHighlight/RelationHighlightController.js"></script>	
	<script type="text/javascript" src="scripts/PackageExplorer/PackageExplorerController.js"></script>	
	<script type="text/javascript" src="scripts/Search/SearchController.js"></script>
	<script type="text/javascript" src="scripts/Experiment/ExperimentController.js"></script>
	<script type="text/javascript" src="scripts/SourceCode/SourceCodeController.js"></script>
	<script type="text/javascript" src="scripts/InteractionLogger/InteractionLogger.js"></script>
	<script type="text/javascript" src="scripts/Email/EmailController.js"></script>
    <script type="text/javascript" src="scripts/GenerationForm/GenerationFormController.js"></script>
	<script type="text/javascript" src="scripts/Menu/MenuController.js"></script>
	<script type="text/javascript" src="scripts/Legend/LegendController.js"></script>
    <script type="text/javascript" src="scripts/Systeminfo/SysteminfoController.js"></script>
    <script type="text/javascript" src="scripts/PatternConnector/PatternConnectorController.js"></script>
    <script type="text/javascript" src="scripts/Configuration/ConfigurationController.js"></script>
    <script type="text/javascript" src="scripts/PatternExplorer/PatternExplorerController.js"></script>
    <script type="text/javascript" src="scripts/VersionExplorer/VersionExplorerController.js"></script>
    <script type="text/javascript" src="scripts/IssueExplorer/IssueExplorerController.js"></script>
    
     <!-- filter -->
    <script type="text/javascript" src="scripts/Filter/Helpers/Constants.js"></script>
    <script type="text/javascript" src="scripts/Filter/Helpers/DOMHelper.js"></script>
    <script type="text/javascript" src="scripts/Filter/Helpers/RelationHelper.js"></script>
    <script type="text/javascript" src="scripts/Filter/Helpers/FilterHelper.js"></script>
    <script type="text/javascript" src="scripts/Filter/Helpers/TransformationHelper.js"></script>
    <script type="text/javascript" src="scripts/Filter/Classes/Filter.js"></script>
    <script type="text/javascript" src="scripts/Filter/Classes/Container.js"></script>
    <script type="text/javascript" src="scripts/Filter/Classes/Layer.js"></script>
    <script type="text/javascript" src="scripts/Filter/FilterController.js"></script>

    <!--user interface-->
	<script type="text/javascript" src="scripts/DefaultLogger.js"></script>
	<script type="text/javascript" src="scripts/Model.js"></script>	
	<script type="text/javascript" src="scripts/Events.js"></script>

    <?php echo $loadVisualizationSpecificScripts; ?>

    <script type="text/javascript" src="scripts/Application.js"></script>

    <link rel="stylesheet" href="Style.css" type="text/css" />

	<!--setup-->	
	<script type="text/javascript" src="<?php echo $setupUrl; ?>"></script>

</head>
<body>
	<div id="canvas">
        <?php echo $canvas; ?>
    </div>
</body>
</html>
