<?php
/*
    Copyright 2017 Gabriel Genois

    This file is part of Aurelius.

    Aurelius is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    Aurelius is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with Aurelius.  If not, see <http://www.gnu.org/licenses/>.

*/
header('Cache-Control: no-cache');
header('Pragma: no-cache');

  require('core.php');

  class greater extends core {
    public function init() {
      echo $this->coreInit();
    }
  }
  $sys = new greater;
  $sys->init();
