<?php

ini_set('session.auto_start', '0');
ini_set('session.use_cookies', '1');
ini_set('session.hash_function', 'sha512');
ini_set('session.hash_bits_per_character', 5);
ini_set('session.use_only_cookies', '1');
ini_set('session.use_trans_sid', '0');
ini_set('session.cache_limiter', 'nocache');
ini_set('session.use_strict_mode', '1');
ini_set('session.gc_probability', '1');
ini_set('session.gc_divisor', '100');
ini_set('session.gc_maxlifetime', '1440');
