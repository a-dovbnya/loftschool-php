<?php

const PICTURES = 80;
const MARKER_DRAWING = 23;
const PENCIL_DRAWING = 40;

$inkDrawing = PICTURES - MARKER_DRAWING - PENCIL_DRAWING;

echo "
    <b>Дано:</b><br/>
    Всего рисунков: ". PICTURES ."<br/>
    Рисунков фломастерами: ". MARKER_DRAWING ."<br/>
    Рисунков карандашами: ". PENCIL_DRAWING ."<br/>
    -----------------------------------------<br/>
    Рисунков красками = Всего рисунков - Рисунков фломастерами - Рисунков карандашами = $inkDrawing
";

