<?php

use thiagoalessio\TesseractOCR\TesseractOCR;
echo (new TesseractOCR('bukti.png'))
    ->run();
	
	?>