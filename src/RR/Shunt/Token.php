<?php

/*!
 * PHP Shunting-yard Implementation
 * Copyright 2012 - droptable <murdoc@raidrush.org>
 *
 * PHP 5.4 required
 *
 * Reference: <http://en.wikipedia.org/wiki/Shunting-yard_algorithm>
 *
 * ----------------------------------------------------------------
 *
 * Permission is hereby granted, free of charge, to any person obtaining a
 * copy of this software and associated documentation files (the "Software"),
 * to deal in the Software without restriction, including without
 * limitation the rights to use, copy, modify, merge, publish, distribute,
 * sublicense, and/or sell copies of the Software, and to permit persons to
 * whom the Software is furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included
 * in all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED,
 * INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR
 * PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS
 * BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT,
 * TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR
 * OTHER DEALINGS IN THE SOFTWARE.
 *
 * <http://opensource.org/licenses/mit-license.php>
 */

namespace RR\Shunt;

class Token
{

    const T_NUMBER      = 1,  // a number (integer / double)
          T_IDENT       = 2,  // constant
          T_FUNCTION    = 4,  // function
          T_POPEN       = 8,  // (
          T_PCLOSE      = 16, // )
          T_COMMA       = 32, // ,
          T_OPERATOR    = 64, // operator (currently unused)
          T_PLUS        = 65, // +
          T_MINUS       = 66, // -
          T_TIMES       = 67, // *
          T_DIV         = 68, // /
          T_MOD         = 69, // %
          T_POW         = 70, // ^
          T_UNARY_PLUS  = 71, // + unsigned number (determined during parsing)
          T_UNARY_MINUS = 72, // - signed number (determined during parsing)
          T_NOT         = 73, // !
          T_NULL        = 128; // null

    public $type, $value, $argc = 0;

    public function __construct($type, $value)
    {
        $this->type  = $type;
        $this->value = $value;
    }

    /**
     * @return string The name of the constant matching the token type
     */
    public function getTypeName()
    {
        $constants = (new \ReflectionClass($this))->getConstants();
        $flipped = array_flip($constants);
        return $flipped[$this->type];
    }
}
