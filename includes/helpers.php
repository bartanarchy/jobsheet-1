<?php
// includes/helpers.php
// Escape output to prevent XSS.

function e($value)
{
    return htmlspecialchars((string) ($value ?? ''), ENT_QUOTES, 'UTF-8');
}