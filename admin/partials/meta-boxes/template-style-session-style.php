<?php

if ( age_fs()->is_not_paying() ) {
    $session_types = array( 'Plenary' );
}
$fonts = array(
    'Arial, Helvetica, Sans-Serif',
    'Arial Black, Gadget, Sans-Serif',
    'Comic Sans MS, Textile, Cursive',
    'Courier New, Courier, Monospace',
    'Georgia, Times New Roman, Times, Serif',
    'Impact, Charcoal, Sans-Serif',
    'Lucida Console, Monaco, Monospace',
    'Lucida Sans Unicode, Lucida Grande, Sans-Serif',
    'Palatino Linotype, Book Antiqua, Palatino, Serif',
    'Tahoma, Geneva, Sans-Serif',
    'Times New Roman, Times, Serif',
    'Trebuchet MS, Helvetica, Sans-Serif',
    'Verdana, Geneva, Sans-Serif',
    'MS Sans Serif, Geneva, Sans-Serif',
    'MS Serif, New York, Serif'
);
$html = '<ul class="agandapress-session-type-menu">';
foreach ( $session_types as $key => $session_type ) {
    $session_type_as_id = str_replace( ' ', '_', strtolower( $session_type ) );
    $html .= '<li>';
    $html .= '<a href="#' . $session_type_as_id . '">';
    $html .= __( 'Session Type 0', 'agandapress' ) . ((int) $key + 1);
    $html .= '</a>';
    $html .= '</li>';
}
$html .= '</ul>';
$html .= '<div class="agandapress-session-type-menu-tab">';
$html .= '<h4>' . __( 'Agenda Styling', 'agandapress' ) . '</h4>';
foreach ( $session_types as $key => $session_type ) {
    $session_type_as_id = str_replace( ' ', '_', strtolower( $session_type ) );
    $html .= '<div id="' . $session_type_as_id . '" class="agandapress-session-type-menu-tab-single">';
    $html .= '<p> <b>' . __( 'Session Type 0', 'agandapress' ) . '' . ((int) $key + 1) . ' : </b> <input value="' . $session_type . '"></p>';
    $html .= '<div>';
    $html .= '<div class="style-box-container">';
    $html .= '<div class="style-box-row column">';
    $html .= '<div class="style-box">';
    $html .= '<div class="style-box-inner">';
    $html .= '<h4>' . __( 'Title Styling ', 'agandapress' ) . '</h4>';
    $html .= '
				<table width="100%">
					<tr>
						<td width="50%">
							' . __( 'Title Font', 'agandapress' ) . '
						</td>
						<td>
							<select name="gt[style][' . $session_type_as_id . '][title][font]">';
    foreach ( $fonts as $key => $font ) {
        $html .= '<option value="' . $font . '" ' . $this->check_op_value( $font, $style[$session_type_as_id]['title']['font'] ) . '>' . $font . '</option>';
    }
    $html .= '</select>
						</td>
					</tr>
					<tr>
						<td>
							' . __( 'Title Font Size', 'agandapress' ) . '
						</td>
						<td>
							<select name="gt[style][' . $session_type_as_id . '][title][font_size]">';
    for ( $size = 6 ;  $size < 23 ;  $size++ ) {
        $html .= '<option value="' . $size . 'px" ' . $this->check_op_value( '' . $size . 'px', $style[$session_type_as_id]['title']['font_size'] ) . '>' . $size . 'px</option>';
    }
    $html .= '</select>
						</td>
					</tr>
					<tr>
						<td>
							' . __( 'Title Font Color', 'agandapress' ) . '
						</td>
						<td>
							<input type="color" name="gt[style][' . $session_type_as_id . '][title][color]" value="' . $style[$session_type_as_id]['title']['color'] . '">
						</td>
					</tr>
					<tr> 
						<td>
							' . __( 'Title Font Aligenment', 'agandapress' ) . '
						</td>
						<td>
							<div class="squer-radio">
								<input ' . $this->check_rc_value( 'left', $style[$session_type_as_id]['title']['font_aligenment'] ) . ' type="radio" value="left" name="gt[style][' . $session_type_as_id . '][title][font_aligenment]" id="gt[style][' . $session_type_as_id . '][title][font_aligenment][left]">
								<label for="gt[style][' . $session_type_as_id . '][title][font_aligenment][left]"><svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="align-left" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="svg-inline--fa fa-align-left fa-w-14 fa-3x"><path fill="currentColor" d="M288 44v40c0 8.837-7.163 16-16 16H16c-8.837 0-16-7.163-16-16V44c0-8.837 7.163-16 16-16h256c8.837 0 16 7.163 16 16zM0 172v40c0 8.837 7.163 16 16 16h416c8.837 0 16-7.163 16-16v-40c0-8.837-7.163-16-16-16H16c-8.837 0-16 7.163-16 16zm16 312h416c8.837 0 16-7.163 16-16v-40c0-8.837-7.163-16-16-16H16c-8.837 0-16 7.163-16 16v40c0 8.837 7.163 16 16 16zm256-200H16c-8.837 0-16 7.163-16 16v40c0 8.837 7.163 16 16 16h256c8.837 0 16-7.163 16-16v-40c0-8.837-7.163-16-16-16z" class=""></path></svg></label>
								<input ' . $this->check_rc_value( 'center', $style[$session_type_as_id]['title']['font_aligenment'] ) . ' type="radio" value="center" name="gt[style][' . $session_type_as_id . '][title][font_aligenment]" id="gt[style][' . $session_type_as_id . '][title][font_aligenment][center]">
								<label for="gt[style][' . $session_type_as_id . '][title][font_aligenment][center]"><svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="align-center" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="svg-inline--fa fa-align-center fa-w-14 fa-3x"><path fill="currentColor" d="M352 44v40c0 8.837-7.163 16-16 16H112c-8.837 0-16-7.163-16-16V44c0-8.837 7.163-16 16-16h224c8.837 0 16 7.163 16 16zM16 228h416c8.837 0 16-7.163 16-16v-40c0-8.837-7.163-16-16-16H16c-8.837 0-16 7.163-16 16v40c0 8.837 7.163 16 16 16zm0 256h416c8.837 0 16-7.163 16-16v-40c0-8.837-7.163-16-16-16H16c-8.837 0-16 7.163-16 16v40c0 8.837 7.163 16 16 16zm320-200H112c-8.837 0-16 7.163-16 16v40c0 8.837 7.163 16 16 16h224c8.837 0 16-7.163 16-16v-40c0-8.837-7.163-16-16-16z" class=""></path></svg></label>
								<input type="radio" value="right" name="gt[style][' . $session_type_as_id . '][title][font_aligenment]" id="gt[style][' . $session_type_as_id . '][title][font_aligenment][right]">
								<label ' . $this->check_rc_value( 'right', $style[$session_type_as_id]['title']['font_aligenment'] ) . ' for="gt[style][' . $session_type_as_id . '][title][font_aligenment][right]"><svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="align-right" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="svg-inline--fa fa-align-right fa-w-14 fa-3x"><path fill="currentColor" d="M160 84V44c0-8.837 7.163-16 16-16h256c8.837 0 16 7.163 16 16v40c0 8.837-7.163 16-16 16H176c-8.837 0-16-7.163-16-16zM16 228h416c8.837 0 16-7.163 16-16v-40c0-8.837-7.163-16-16-16H16c-8.837 0-16 7.163-16 16v40c0 8.837 7.163 16 16 16zm0 256h416c8.837 0 16-7.163 16-16v-40c0-8.837-7.163-16-16-16H16c-8.837 0-16 7.163-16 16v40c0 8.837 7.163 16 16 16zm160-128h256c8.837 0 16-7.163 16-16v-40c0-8.837-7.163-16-16-16H176c-8.837 0-16 7.163-16 16v40c0 8.837 7.163 16 16 16z" class=""></path></svg></label>
							</div>
						</td>
					</tr>
					<tr>
						<td>
							' . __( 'Title Font Style', 'agandapress' ) . '
						</td>
						<td>
							<div class="squer-radio">
								<input ' . $this->check_rc_value( 'bold', $style[$session_type_as_id]['title']['font_style']['bold'] ) . ' type="checkbox" value="bold" name="gt[style][' . $session_type_as_id . '][title][font_style][bold]" id="gt[style][' . $session_type_as_id . '][title][font_style][bold]">
								<label for="gt[style][' . $session_type_as_id . '][title][font_style][bold]"><svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="bold" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" class="svg-inline--fa fa-bold fa-w-12 fa-3x"><path fill="currentColor" d="M304.793 243.891c33.639-18.537 53.657-54.16 53.657-95.693 0-48.236-26.25-87.626-68.626-104.179C265.138 34.01 240.849 32 209.661 32H24c-8.837 0-16 7.163-16 16v33.049c0 8.837 7.163 16 16 16h33.113v318.53H24c-8.837 0-16 7.163-16 16V464c0 8.837 7.163 16 16 16h195.69c24.203 0 44.834-1.289 66.866-7.584C337.52 457.193 376 410.647 376 350.014c0-52.168-26.573-91.684-71.207-106.123zM142.217 100.809h67.444c16.294 0 27.536 2.019 37.525 6.717 15.828 8.479 24.906 26.502 24.906 49.446 0 35.029-20.32 56.79-53.029 56.79h-76.846V100.809zm112.642 305.475c-10.14 4.056-22.677 4.907-31.409 4.907h-81.233V281.943h84.367c39.645 0 63.057 25.38 63.057 63.057.001 28.425-13.66 52.483-34.782 61.284z" class=""></path></svg></label>
								<input ' . $this->check_rc_value( 'italic', $style[$session_type_as_id]['title']['font_style']['italic'] ) . ' type="checkbox" value="italic" name="gt[style][' . $session_type_as_id . '][title][font_style][italic]" id="gt[style][' . $session_type_as_id . '][title][font_style][italic]">
								<label for="gt[style][' . $session_type_as_id . '][title][font_style][italic]"><svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="italic" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" class="svg-inline--fa fa-italic fa-w-10 fa-3x"><path fill="currentColor" d="M204.758 416h-33.849l62.092-320h40.725a16 16 0 0 0 15.704-12.937l6.242-32C297.599 41.184 290.034 32 279.968 32H120.235a16 16 0 0 0-15.704 12.937l-6.242 32C96.362 86.816 103.927 96 113.993 96h33.846l-62.09 320H46.278a16 16 0 0 0-15.704 12.935l-6.245 32C22.402 470.815 29.967 480 40.034 480h158.479a16 16 0 0 0 15.704-12.935l6.245-32c1.927-9.88-5.638-19.065-15.704-19.065z" class=""></path></svg></label>
								<input ' . $this->check_rc_value( 'underline', $style[$session_type_as_id]['title']['font_style']['underline'] ) . ' type="checkbox" value="underline" name="gt[style][' . $session_type_as_id . '][title][font_style][underline]" id="gt[style][' . $session_type_as_id . '][title][font_style][underline]">
								<label for="gt[style][' . $session_type_as_id . '][title][font_style][underline]"><svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="underline" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="svg-inline--fa fa-underline fa-w-14 fa-3x"><path fill="currentColor" d="M224.264 388.24c-91.669 0-156.603-51.165-156.603-151.392V64H39.37c-8.837 0-16-7.163-16-16V16c0-8.837 7.163-16 16-16h137.39c8.837 0 16 7.163 16 16v32c0 8.837-7.163 16-16 16h-28.813v172.848c0 53.699 28.314 79.444 76.317 79.444 46.966 0 75.796-25.434 75.796-79.965V64h-28.291c-8.837 0-16-7.163-16-16V16c0-8.837 7.163-16 16-16h136.868c8.837 0 16 7.163 16 16v32c0 8.837-7.163 16-16 16h-28.291v172.848c0 99.405-64.881 151.392-156.082 151.392zM16 448h416c8.837 0 16 7.163 16 16v32c0 8.837-7.163 16-16 16H16c-8.837 0-16-7.163-16-16v-32c0-8.837 7.163-16 16-16z" class=""></path></svg></label>
							</div>
						</td>
					</tr>
					<tr>
						<td>
							' . __( 'Heading', 'agandapress' ) . '
						</td>
						<td>
							<select name="gt[style][' . $session_type_as_id . '][title][heading]" >
								<option value="H1" ' . $this->check_op_value( 'H1', $style[$session_type_as_id]['title']['heading'] ) . '>H1</option>
								<option value="H2" ' . $this->check_op_value( 'H2', $style[$session_type_as_id]['title']['heading'] ) . '>H2</option>
								<option value="H3" ' . $this->check_op_value( 'H3', $style[$session_type_as_id]['title']['heading'] ) . '>H3</option>
								<option value="H4" ' . $this->check_op_value( 'H4', $style[$session_type_as_id]['title']['heading'] ) . '>H4</option>
								<option value="H5" ' . $this->check_op_value( 'H5', $style[$session_type_as_id]['title']['heading'] ) . '>H5</option>
								<option value="H6" ' . $this->check_op_value( 'H6', $style[$session_type_as_id]['title']['heading'] ) . '>H6</option>
							</select>
						</td>
					</tr>
				</table>';
    $html .= '</div>';
    $html .= '</div>';
    $html .= '<div class="style-box">';
    $html .= '<div class="style-box-inner">';
    $html .= '<h4>' . __( 'Agenda Container Styling (Table)', 'agandapress' ) . '</h4>';
    $html .= '
				<table width="100%">
					<tr>
						<td width="50%">
							' . __( 'Background Color', 'agandapress' ) . '
						</td>
						<td>
							<input type="color" name="gt[style][' . $session_type_as_id . '][agenda_container][bgcolor]" value="' . $style[$session_type_as_id]['agenda_container']['bgcolor'] . '">
						</td>
					</tr>
					<tr>
						<td>
							' . __( 'Border Line Style', 'agandapress' ) . '
						</td>
						<td>
							<select name="gt[style][' . $session_type_as_id . '][agenda_container][border_style]" >
							<option value="dotted" ' . $this->check_op_value( 'dotted', $style[$session_type_as_id]['agenda_container']['border_style'] ) . '>dotted</option>
							<option value="dashed" ' . $this->check_op_value( 'dashed', $style[$session_type_as_id]['agenda_container']['border_style'] ) . '>dashed</option>
							<option value="solid" ' . $this->check_op_value( 'solid', $style[$session_type_as_id]['agenda_container']['border_style'] ) . '>solid</option>
							<option value="double" ' . $this->check_op_value( 'double', $style[$session_type_as_id]['agenda_container']['border_style'] ) . '>double</option>
							<option value="groove" ' . $this->check_op_value( 'groove', $style[$session_type_as_id]['agenda_container']['border_style'] ) . '>groove</option>
							<option value="ridge" ' . $this->check_op_value( 'ridge', $style[$session_type_as_id]['agenda_container']['border_style'] ) . '>ridge</option>
							<option value="inset" ' . $this->check_op_value( 'inset', $style[$session_type_as_id]['agenda_container']['border_style'] ) . '>inset</option>
							<option value="outset" ' . $this->check_op_value( 'outset', $style[$session_type_as_id]['agenda_container']['border_style'] ) . '>outset</option>
							</select>
						</td>
					</tr>
					<tr>
						<td>
							' . __( 'Border Line Width', 'agandapress' ) . '
						</td>
						<td>
							<select name="gt[style][' . $session_type_as_id . '][agenda_container][border_width]">
								<option value="1px" ' . $this->check_op_value( '1px', $style[$session_type_as_id]['agenda_container']['border_width'] ) . '>1px</option>
								<option value="2px" ' . $this->check_op_value( '2px', $style[$session_type_as_id]['agenda_container']['border_width'] ) . '>2px</option>
								<option value="3px" ' . $this->check_op_value( '3px', $style[$session_type_as_id]['agenda_container']['border_width'] ) . '>3px</option>
								<option value="4px" ' . $this->check_op_value( '4px', $style[$session_type_as_id]['agenda_container']['border_width'] ) . '>4px</option>
								<option value="5px" ' . $this->check_op_value( '5px', $style[$session_type_as_id]['agenda_container']['border_width'] ) . '>5px</option>
							</select>
						</td>
					</tr>
					<tr>
						<td>
							' . __( 'Border Line Color', 'agandapress' ) . '
						</td>
						<td>
							<input type="color" name="gt[style][' . $session_type_as_id . '][agenda_container][border_color]" value="' . $style[$session_type_as_id]['agenda_container']['border_color'] . '">
						</td>
					</tr>
					<tr>
						<td>
							' . __( 'Background Image', 'agandapress' ) . '
						</td>
						<td>
							
						</td>
					</tr>
					<tr>
						<td>
							' . __( 'Padding', 'agandapress' ) . '
						</td>
						<td>
							<input type="text" name="gt[style][' . $session_type_as_id . '][agenda_container][padding]" value="' . $style[$session_type_as_id]['agenda_container']['padding'] . '">

						</td>
					</tr>
					<tr>
						<td>
							' . __( 'Margin', 'agandapress' ) . '
						</td>
						<td>
							<input type="text" name="gt[style][' . $session_type_as_id . '][agenda_container][margin]" value="' . $style[$session_type_as_id]['agenda_container']['margin'] . '">
						</td>
					</tr>
				</table>';
    $html .= '</div>';
    $html .= '</div>';
    $html .= '<div class="style-box">';
    $html .= '<div class="style-box-inner">';
    $html .= '<h4>' . __( 'Secission Container Styling (Cell) ', 'agandapress' ) . '</h4>';
    $html .= '
				<table width="100%">
					<tr>
						<td width="50%">
							' . __( 'Background Color', 'agandapress' ) . '
						</td>
						<td>
							<input type="color" name="gt[style][' . $session_type_as_id . '][session_container][bgcolor]"  value="' . $style[$session_type_as_id]['session_container']['bgcolor'] . '">
						</td>
					</tr>
					<tr>
						<td>
							' . __( 'Border Line Style', 'agandapress' ) . '
						</td>
						<td>
							<select name="gt[style][' . $session_type_as_id . '][session_container][border_style]">
							<option value="dotted" ' . $this->check_op_value( 'dotted', $style[$session_type_as_id]['session_container']['border_style'] ) . '>dotted</option>
							<option value="dashed" ' . $this->check_op_value( 'dashed', $style[$session_type_as_id]['session_container']['border_style'] ) . '>dashed</option>
							<option value="solid" ' . $this->check_op_value( 'solid', $style[$session_type_as_id]['session_container']['border_style'] ) . '>solid</option>
							<option value="double" ' . $this->check_op_value( 'double', $style[$session_type_as_id]['session_container']['border_style'] ) . '>double</option>
							<option value="groove" ' . $this->check_op_value( 'groove', $style[$session_type_as_id]['session_container']['border_style'] ) . '>groove</option>
							<option value="ridge" ' . $this->check_op_value( 'ridge', $style[$session_type_as_id]['session_container']['border_style'] ) . '>ridge</option>
							<option value="inset" ' . $this->check_op_value( 'inset', $style[$session_type_as_id]['session_container']['border_style'] ) . '>inset</option>
							<option value="outset" ' . $this->check_op_value( 'outset', $style[$session_type_as_id]['session_container']['border_style'] ) . '>outset</option>
							</select>
						</td>
					</tr>
					<tr>
						<td>
							' . __( 'Border Line Width', 'agandapress' ) . '
						</td>
						<td>
							<select name="gt[style][' . $session_type_as_id . '][session_container][border_width]">
								<option value="1px" ' . $this->check_op_value( '1px', $style[$session_type_as_id]['session_container']['border_width'] ) . '>1px</option>
								<option value="2px" ' . $this->check_op_value( '2px', $style[$session_type_as_id]['session_container']['border_width'] ) . '>2px</option>
								<option value="3px" ' . $this->check_op_value( '3px', $style[$session_type_as_id]['session_container']['border_width'] ) . '>3px</option>
								<option value="4px" ' . $this->check_op_value( '4px', $style[$session_type_as_id]['session_container']['border_width'] ) . '>4px</option>
								<option value="5px" ' . $this->check_op_value( '5px', $style[$session_type_as_id]['session_container']['border_width'] ) . '>5px</option>
							</select>
						</td>
					</tr>
					<tr>
						<td>
							' . __( 'Border Line Color', 'agandapress' ) . '
						</td>
						<td>
							<input type="color" name="gt[style][' . $session_type_as_id . '][session_container][border_color]" value="' . $style[$session_type_as_id]['session_container']['border_color'] . '">
						</td>
					</tr>
					<tr>
						<td>
							' . __( 'Padding', 'agandapress' ) . '
						</td>
						<td>
							<input type="text" value="' . $style[$session_type_as_id]['session_container']['padding'] . '" name="gt[style][' . $session_type_as_id . '][session_container][padding]">
						</td>
					</tr>
					<tr>
						<td>
							' . __( 'Margin', 'agandapress' ) . '
						</td>
						<td>
							<input type="text" value="' . $style[$session_type_as_id]['session_container']['margin'] . '" name="gt[style][' . $session_type_as_id . '][session_container][margin]">
						</td>
					</tr>
				</table>';
    $html .= '</div>';
    $html .= '</div>';
    $html .= '<div class="style-box">';
    $html .= '<div class="style-box-inner">';
    $html .= '<h4>' . __( 'Speaker Styling ', 'agandapress' ) . '</h4>';
    $html .= '
				<table width="100%">
					<tr>
						<td  width="50%">
							' . __( 'Speaker Show/Hide', 'agandapress' ) . '
						</td>
						<td>
							<input type="checkbox" name="gt[style][' . $session_type_as_id . '][speaker][show]" ' . $this->check_rc_value( 'on', $style[$session_type_as_id]['speaker']['show'] ) . '>
						</td>
					</tr>
					<tr>
						<td>
							' . __( 'Speaker Image', 'agandapress' ) . '
						</td>
						<td>
							<input type="checkbox" name="gt[style][' . $session_type_as_id . '][speaker][image]" ' . $this->check_rc_value( 'on', $style[$session_type_as_id]['speaker']['image'] ) . '>
						</td>
					</tr>

					<tr>
						<td>
							' . __( 'Speaker Name Font', 'agandapress' ) . '
						</td>
						<td>
							<select name="gt[style][' . $session_type_as_id . '][speaker][font]">';
    foreach ( $fonts as $key => $font ) {
        $html .= '<option value="' . $font . '" ' . $this->check_op_value( $font, $style[$session_type_as_id]['speaker']['font'] ) . '>' . $font . '</option>';
    }
    $html .= '</select>
						</td>
					</tr>

					<tr>
						<td>
							' . __( 'Speaker Name Font Size', 'agandapress' ) . '
						</td>
						<td>
							<select name="gt[style][' . $session_type_as_id . '][speaker][font_size]">';
    for ( $size = 6 ;  $size < 23 ;  $size++ ) {
        $html .= '<option value="' . $size . 'px" ' . $this->check_op_value( '' . $size . 'px', $style[$session_type_as_id]['speaker']['font_size'] ) . '>' . $size . 'px</option>';
    }
    $html .= '</select>
						</td>
					</tr>

					<tr>
						<td>
							' . __( 'Speaker Name Font Color', 'agandapress' ) . '
						</td>
						<td>
							<input type="color" name="gt[style][' . $session_type_as_id . '][speaker][font_color]" value="' . $style[$session_type_as_id]['speaker']['font_color'] . '">
						</td>
					</tr>

					<tr>
						<td>
							' . __( 'Speaker Font Aligenment', 'agandapress' ) . '
						</td>
						<td>
							<div class="squer-radio">
								<input ' . $this->check_rc_value( 'left', $style[$session_type_as_id]['speaker']['font_aligenment'] ) . ' type="radio" value="left" name="gt[style][' . $session_type_as_id . '][speaker][font_aligenment]" id="gt[style][' . $session_type_as_id . '][speaker][font_aligenment][left]">
								<label for="gt[style][' . $session_type_as_id . '][speaker][font_aligenment][left]"><svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="align-left" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="svg-inline--fa fa-align-left fa-w-14 fa-3x"><path fill="currentColor" d="M288 44v40c0 8.837-7.163 16-16 16H16c-8.837 0-16-7.163-16-16V44c0-8.837 7.163-16 16-16h256c8.837 0 16 7.163 16 16zM0 172v40c0 8.837 7.163 16 16 16h416c8.837 0 16-7.163 16-16v-40c0-8.837-7.163-16-16-16H16c-8.837 0-16 7.163-16 16zm16 312h416c8.837 0 16-7.163 16-16v-40c0-8.837-7.163-16-16-16H16c-8.837 0-16 7.163-16 16v40c0 8.837 7.163 16 16 16zm256-200H16c-8.837 0-16 7.163-16 16v40c0 8.837 7.163 16 16 16h256c8.837 0 16-7.163 16-16v-40c0-8.837-7.163-16-16-16z" class=""></path></svg></label>
								<input ' . $this->check_rc_value( 'center', $style[$session_type_as_id]['speaker']['font_aligenment'] ) . ' type="radio" value="center" name="gt[style][' . $session_type_as_id . '][speaker][font_aligenment]" id="gt[style][' . $session_type_as_id . '][speaker][font_aligenment][center]">
								<label for="gt[style][' . $session_type_as_id . '][speaker][font_aligenment][center]"><svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="align-center" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="svg-inline--fa fa-align-center fa-w-14 fa-3x"><path fill="currentColor" d="M352 44v40c0 8.837-7.163 16-16 16H112c-8.837 0-16-7.163-16-16V44c0-8.837 7.163-16 16-16h224c8.837 0 16 7.163 16 16zM16 228h416c8.837 0 16-7.163 16-16v-40c0-8.837-7.163-16-16-16H16c-8.837 0-16 7.163-16 16v40c0 8.837 7.163 16 16 16zm0 256h416c8.837 0 16-7.163 16-16v-40c0-8.837-7.163-16-16-16H16c-8.837 0-16 7.163-16 16v40c0 8.837 7.163 16 16 16zm320-200H112c-8.837 0-16 7.163-16 16v40c0 8.837 7.163 16 16 16h224c8.837 0 16-7.163 16-16v-40c0-8.837-7.163-16-16-16z" class=""></path></svg></label>
								<input ' . $this->check_rc_value( 'right', $style[$session_type_as_id]['speaker']['font_aligenment'] ) . ' type="radio" value="right" name="gt[style][' . $session_type_as_id . '][speaker][font_aligenment]" id="gt[style][' . $session_type_as_id . '][speaker][font_aligenment][right]">
								<label for="gt[style][' . $session_type_as_id . '][speaker][font_aligenment][right]"><svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="align-right" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="svg-inline--fa fa-align-right fa-w-14 fa-3x"><path fill="currentColor" d="M160 84V44c0-8.837 7.163-16 16-16h256c8.837 0 16 7.163 16 16v40c0 8.837-7.163 16-16 16H176c-8.837 0-16-7.163-16-16zM16 228h416c8.837 0 16-7.163 16-16v-40c0-8.837-7.163-16-16-16H16c-8.837 0-16 7.163-16 16v40c0 8.837 7.163 16 16 16zm0 256h416c8.837 0 16-7.163 16-16v-40c0-8.837-7.163-16-16-16H16c-8.837 0-16 7.163-16 16v40c0 8.837 7.163 16 16 16zm160-128h256c8.837 0 16-7.163 16-16v-40c0-8.837-7.163-16-16-16H176c-8.837 0-16 7.163-16 16v40c0 8.837 7.163 16 16 16z" class=""></path></svg></label>
							</div>
						</td>
					</tr>
					<tr>
						<td>
							' . __( 'Speaker Font Style', 'agandapress' ) . '
						</td>
						<td>
							<div class="squer-radio">
								<input ' . $this->check_rc_value( 'bold', $style[$session_type_as_id]['speaker']['font_style']['bold'] ) . ' type="checkbox" value="bold" name="gt[style][' . $session_type_as_id . '][speaker][font_style][bold]" id="gt[style][' . $session_type_as_id . '][speaker][font_style][bold]">
								<label for="gt[style][' . $session_type_as_id . '][speaker][font_style][bold]"><svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="bold" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" class="svg-inline--fa fa-bold fa-w-12 fa-3x"><path fill="currentColor" d="M304.793 243.891c33.639-18.537 53.657-54.16 53.657-95.693 0-48.236-26.25-87.626-68.626-104.179C265.138 34.01 240.849 32 209.661 32H24c-8.837 0-16 7.163-16 16v33.049c0 8.837 7.163 16 16 16h33.113v318.53H24c-8.837 0-16 7.163-16 16V464c0 8.837 7.163 16 16 16h195.69c24.203 0 44.834-1.289 66.866-7.584C337.52 457.193 376 410.647 376 350.014c0-52.168-26.573-91.684-71.207-106.123zM142.217 100.809h67.444c16.294 0 27.536 2.019 37.525 6.717 15.828 8.479 24.906 26.502 24.906 49.446 0 35.029-20.32 56.79-53.029 56.79h-76.846V100.809zm112.642 305.475c-10.14 4.056-22.677 4.907-31.409 4.907h-81.233V281.943h84.367c39.645 0 63.057 25.38 63.057 63.057.001 28.425-13.66 52.483-34.782 61.284z" class=""></path></svg></label>
								<input ' . $this->check_rc_value( 'italic', $style[$session_type_as_id]['speaker']['font_style']['italic'] ) . ' type="checkbox" value="italic" name="gt[style][' . $session_type_as_id . '][speaker][font_style][italic]" id="gt[style][' . $session_type_as_id . '][speaker][font_style][italic]">
								<label for="gt[style][' . $session_type_as_id . '][speaker][font_style][italic]"><svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="italic" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" class="svg-inline--fa fa-italic fa-w-10 fa-3x"><path fill="currentColor" d="M204.758 416h-33.849l62.092-320h40.725a16 16 0 0 0 15.704-12.937l6.242-32C297.599 41.184 290.034 32 279.968 32H120.235a16 16 0 0 0-15.704 12.937l-6.242 32C96.362 86.816 103.927 96 113.993 96h33.846l-62.09 320H46.278a16 16 0 0 0-15.704 12.935l-6.245 32C22.402 470.815 29.967 480 40.034 480h158.479a16 16 0 0 0 15.704-12.935l6.245-32c1.927-9.88-5.638-19.065-15.704-19.065z" class=""></path></svg></label>
								<input ' . $this->check_rc_value( 'underline', $style[$session_type_as_id]['speaker']['font_style']['underline'] ) . ' type="checkbox" value="underline" name="gt[style][' . $session_type_as_id . '][speaker][font_style][underline]" id="gt[style][' . $session_type_as_id . '][speaker][font_style][underline]">
								<label for="gt[style][' . $session_type_as_id . '][speaker][font_style][underline]"><svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="underline" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="svg-inline--fa fa-underline fa-w-14 fa-3x"><path fill="currentColor" d="M224.264 388.24c-91.669 0-156.603-51.165-156.603-151.392V64H39.37c-8.837 0-16-7.163-16-16V16c0-8.837 7.163-16 16-16h137.39c8.837 0 16 7.163 16 16v32c0 8.837-7.163 16-16 16h-28.813v172.848c0 53.699 28.314 79.444 76.317 79.444 46.966 0 75.796-25.434 75.796-79.965V64h-28.291c-8.837 0-16-7.163-16-16V16c0-8.837 7.163-16 16-16h136.868c8.837 0 16 7.163 16 16v32c0 8.837-7.163 16-16 16h-28.291v172.848c0 99.405-64.881 151.392-156.082 151.392zM16 448h416c8.837 0 16 7.163 16 16v32c0 8.837-7.163 16-16 16H16c-8.837 0-16-7.163-16-16v-32c0-8.837 7.163-16 16-16z" class=""></path></svg></label>
							</div>
						</td>
					</tr>
					<tr>
						<td>
							' . __( 'Speaker Profile Link', 'agandapress' ) . '
						</td>
						<td>
							<input type="checkbox" name="gt[style][' . $session_type_as_id . '][speaker][profile_link]" ' . $this->check_rc_value( 'on', $style[$session_type_as_id]['speaker']['profile_link'] ) . '>
						</td>
					</tr>
				</table>';
    $html .= '</div>';
    $html .= '</div>';
    $html .= '<div class="style-box">';
    $html .= '<div class="style-box-inner">';
    $html .= '<h4>' . __( 'Venue Styling ', 'agandapress' ) . '</h4>';
    $html .= '
				<table width="100%">
					<tr>
						<td  width="50%">
							' . __( 'Venue Show/Hide', 'agandapress' ) . '
						</td>
						<td>
							<input type="checkbox" name="gt[style][' . $session_type_as_id . '][venue][show]" ' . $this->check_rc_value( 'on', $style[$session_type_as_id]['venue']['show'] ) . '>
						</td>
					</tr>
					<tr>
						<td>
							' . __( 'Venue Image', 'agandapress' ) . '
						</td>
						<td>
							<input type="checkbox" name="gt[style][' . $session_type_as_id . '][venue][image]" ' . $this->check_rc_value( 'on', $style[$session_type_as_id]['venue']['image'] ) . '>
						</td>
					</tr>

					<tr>
						<td>
							' . __( 'Venue Font', 'agandapress' ) . '
						</td>
						<td>
							<select name="gt[style][' . $session_type_as_id . '][venue][font]">';
    foreach ( $fonts as $key => $font ) {
        $html .= '<option value="' . $font . '" ' . $this->check_op_value( $font, $style[$session_type_as_id]['venue']['font'] ) . '>' . $font . '</option>';
    }
    $html .= '</select>
						</td>
					</tr>
					<tr>
						<td>
							' . __( 'Venue Font Size', 'agandapress' ) . '
						</td>
						<td>
							<select name="gt[style][' . $session_type_as_id . '][venue][font_size]">';
    for ( $size = 6 ;  $size < 23 ;  $size++ ) {
        $html .= '<option value="' . $size . 'px" ' . $this->check_op_value( '' . $size . 'px', $style[$session_type_as_id]['venue']['font_size'] ) . '>' . $size . 'px</option>';
    }
    $html .= '</select>
						</td>
					</tr>
					<tr>
						<td>
							' . __( 'Venue Font Color', 'agandapress' ) . '
						</td>
						<td>
							<input type="color" name="gt[style][' . $session_type_as_id . '][venue][font_color]" value="' . $style[$session_type_as_id]['venue']['font_color'] . '">
						</td>
					</tr>
					<tr>
						<td>
							' . __( 'Venue Font Aligenment', 'agandapress' ) . '
						</td>
						<td>
							<div class="squer-radio">
								<input ' . $this->check_rc_value( 'left', $style[$session_type_as_id]['venue']['font_aligenment'] ) . ' type="radio" value="left" name="gt[style][' . $session_type_as_id . '][venue][font_aligenment]" id="gt[style][' . $session_type_as_id . '][venue][font_aligenment][left]">
								<label for="gt[style][' . $session_type_as_id . '][venue][font_aligenment][left]"><svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="align-left" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="svg-inline--fa fa-align-left fa-w-14 fa-3x"><path fill="currentColor" d="M288 44v40c0 8.837-7.163 16-16 16H16c-8.837 0-16-7.163-16-16V44c0-8.837 7.163-16 16-16h256c8.837 0 16 7.163 16 16zM0 172v40c0 8.837 7.163 16 16 16h416c8.837 0 16-7.163 16-16v-40c0-8.837-7.163-16-16-16H16c-8.837 0-16 7.163-16 16zm16 312h416c8.837 0 16-7.163 16-16v-40c0-8.837-7.163-16-16-16H16c-8.837 0-16 7.163-16 16v40c0 8.837 7.163 16 16 16zm256-200H16c-8.837 0-16 7.163-16 16v40c0 8.837 7.163 16 16 16h256c8.837 0 16-7.163 16-16v-40c0-8.837-7.163-16-16-16z" class=""></path></svg></label>
								<input ' . $this->check_rc_value( 'center', $style[$session_type_as_id]['venue']['font_aligenment'] ) . ' type="radio" value="center" name="gt[style][' . $session_type_as_id . '][venue][font_aligenment]" id="gt[style][' . $session_type_as_id . '][venue][font_aligenment][center]">
								<label for="gt[style][' . $session_type_as_id . '][venue][font_aligenment][center]"><svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="align-center" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="svg-inline--fa fa-align-center fa-w-14 fa-3x"><path fill="currentColor" d="M352 44v40c0 8.837-7.163 16-16 16H112c-8.837 0-16-7.163-16-16V44c0-8.837 7.163-16 16-16h224c8.837 0 16 7.163 16 16zM16 228h416c8.837 0 16-7.163 16-16v-40c0-8.837-7.163-16-16-16H16c-8.837 0-16 7.163-16 16v40c0 8.837 7.163 16 16 16zm0 256h416c8.837 0 16-7.163 16-16v-40c0-8.837-7.163-16-16-16H16c-8.837 0-16 7.163-16 16v40c0 8.837 7.163 16 16 16zm320-200H112c-8.837 0-16 7.163-16 16v40c0 8.837 7.163 16 16 16h224c8.837 0 16-7.163 16-16v-40c0-8.837-7.163-16-16-16z" class=""></path></svg></label>
								<input ' . $this->check_rc_value( 'right', $style[$session_type_as_id]['venue']['font_aligenment'] ) . ' type="radio" value="right" name="gt[style][' . $session_type_as_id . '][venue][font_aligenment]" id="gt[style][' . $session_type_as_id . '][venue][font_aligenment][right]">
								<label for="gt[style][' . $session_type_as_id . '][venue][font_aligenment][right]"><svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="align-right" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="svg-inline--fa fa-align-right fa-w-14 fa-3x"><path fill="currentColor" d="M160 84V44c0-8.837 7.163-16 16-16h256c8.837 0 16 7.163 16 16v40c0 8.837-7.163 16-16 16H176c-8.837 0-16-7.163-16-16zM16 228h416c8.837 0 16-7.163 16-16v-40c0-8.837-7.163-16-16-16H16c-8.837 0-16 7.163-16 16v40c0 8.837 7.163 16 16 16zm0 256h416c8.837 0 16-7.163 16-16v-40c0-8.837-7.163-16-16-16H16c-8.837 0-16 7.163-16 16v40c0 8.837 7.163 16 16 16zm160-128h256c8.837 0 16-7.163 16-16v-40c0-8.837-7.163-16-16-16H176c-8.837 0-16 7.163-16 16v40c0 8.837 7.163 16 16 16z" class=""></path></svg></label>
							</div>
						</td>
					</tr>
					<tr>
						<td>
							' . __( 'Venue Font Style', 'agandapress' ) . '
						</td>
						<td>
							<div class="squer-radio">
								<input ' . $this->check_rc_value( 'bold', $style[$session_type_as_id]['venue']['font_style']['bold'] ) . ' type="checkbox" value="bold" name="gt[style][' . $session_type_as_id . '][venue][font_style][bold]" id="gt[style][' . $session_type_as_id . '][venue][font_style][bold]">
								<label for="gt[style][' . $session_type_as_id . '][venue][font_style][bold]"><svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="bold" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" class="svg-inline--fa fa-bold fa-w-12 fa-3x"><path fill="currentColor" d="M304.793 243.891c33.639-18.537 53.657-54.16 53.657-95.693 0-48.236-26.25-87.626-68.626-104.179C265.138 34.01 240.849 32 209.661 32H24c-8.837 0-16 7.163-16 16v33.049c0 8.837 7.163 16 16 16h33.113v318.53H24c-8.837 0-16 7.163-16 16V464c0 8.837 7.163 16 16 16h195.69c24.203 0 44.834-1.289 66.866-7.584C337.52 457.193 376 410.647 376 350.014c0-52.168-26.573-91.684-71.207-106.123zM142.217 100.809h67.444c16.294 0 27.536 2.019 37.525 6.717 15.828 8.479 24.906 26.502 24.906 49.446 0 35.029-20.32 56.79-53.029 56.79h-76.846V100.809zm112.642 305.475c-10.14 4.056-22.677 4.907-31.409 4.907h-81.233V281.943h84.367c39.645 0 63.057 25.38 63.057 63.057.001 28.425-13.66 52.483-34.782 61.284z" class=""></path></svg></label>
								<input ' . $this->check_rc_value( 'italic', $style[$session_type_as_id]['venue']['font_style']['italic'] ) . ' type="checkbox" value="italic" name="gt[style][' . $session_type_as_id . '][venue][font_style][italic]" id="gt[style][' . $session_type_as_id . '][venue][font_style][italic]">
								<label for="gt[style][' . $session_type_as_id . '][venue][font_style][italic]"><svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="italic" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" class="svg-inline--fa fa-italic fa-w-10 fa-3x"><path fill="currentColor" d="M204.758 416h-33.849l62.092-320h40.725a16 16 0 0 0 15.704-12.937l6.242-32C297.599 41.184 290.034 32 279.968 32H120.235a16 16 0 0 0-15.704 12.937l-6.242 32C96.362 86.816 103.927 96 113.993 96h33.846l-62.09 320H46.278a16 16 0 0 0-15.704 12.935l-6.245 32C22.402 470.815 29.967 480 40.034 480h158.479a16 16 0 0 0 15.704-12.935l6.245-32c1.927-9.88-5.638-19.065-15.704-19.065z" class=""></path></svg></label>
								<input ' . $this->check_rc_value( 'underline', $style[$session_type_as_id]['venue']['font_style']['underline'] ) . ' type="checkbox" value="underline" name="gt[style][' . $session_type_as_id . '][venue][font_style][underline]" id="gt[style][' . $session_type_as_id . '][venue][font_style][underline]">
								<label for="gt[style][' . $session_type_as_id . '][venue][font_style][underline]"><svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="underline" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="svg-inline--fa fa-underline fa-w-14 fa-3x"><path fill="currentColor" d="M224.264 388.24c-91.669 0-156.603-51.165-156.603-151.392V64H39.37c-8.837 0-16-7.163-16-16V16c0-8.837 7.163-16 16-16h137.39c8.837 0 16 7.163 16 16v32c0 8.837-7.163 16-16 16h-28.813v172.848c0 53.699 28.314 79.444 76.317 79.444 46.966 0 75.796-25.434 75.796-79.965V64h-28.291c-8.837 0-16-7.163-16-16V16c0-8.837 7.163-16 16-16h136.868c8.837 0 16 7.163 16 16v32c0 8.837-7.163 16-16 16h-28.291v172.848c0 99.405-64.881 151.392-156.082 151.392zM16 448h416c8.837 0 16 7.163 16 16v32c0 8.837-7.163 16-16 16H16c-8.837 0-16-7.163-16-16v-32c0-8.837 7.163-16 16-16z" class=""></path></svg></label>
							</div>
						</td>
					</tr>
					<tr>
						<td>
							' . __( 'Venue Details Link', 'agandapress' ) . '
						</td>
						<td>
							<input type="checkbox" name="gt[style][' . $session_type_as_id . '][venue][details_link]" ' . $this->check_rc_value( 'on', $style[$session_type_as_id]['venue']['details_link'] ) . '>
						</td>
					</tr>
				</table>';
    $html .= '</div>';
    $html .= '</div>';
    $html .= '<div class="style-box">';
    $html .= '<div class="style-box-inner">';
    $html .= '<h4>' . __( 'Organization Styling ', 'agandapress' ) . '</h4>';
    $html .= '
				<table width="100%">
					<tr>
						<td  width="50%">
							' . __( 'Organization Show/Hide', 'agandapress' ) . '
						</td>
						<td>
							<input type="checkbox" name="gt[style][' . $session_type_as_id . '][organization][show]" ' . $this->check_rc_value( 'on', $style[$session_type_as_id]['organization']['show'] ) . '>
						</td>
					</tr>
					<tr>
						<td>
							' . __( 'Organization Image', 'agandapress' ) . '
						</td>
						<td>
							<input type="checkbox" name="gt[style][' . $session_type_as_id . '][organization][image]" ' . $this->check_rc_value( 'on', $style[$session_type_as_id]['organization']['image'] ) . '>
						</td>
					</tr>

					<tr>
						<td>
							' . __( 'Organization Font', 'agandapress' ) . '
						</td>
						<td>
							<select name="gt[style][' . $session_type_as_id . '][organization][font]">';
    foreach ( $fonts as $key => $font ) {
        $html .= '<option value="' . $font . '" ' . $this->check_op_value( $font, $style[$session_type_as_id]['organization']['font'] ) . '>' . $font . '</option>';
    }
    $html .= '</select>
						</td>
					</tr>
					<tr>
						<td>
							' . __( 'Organization Font Size', 'agandapress' ) . '
						</td>
						<td>
							<select name="gt[style][' . $session_type_as_id . '][organization][font_size]">';
    for ( $size = 6 ;  $size < 23 ;  $size++ ) {
        $html .= '<option value="' . $size . 'px" ' . $this->check_op_value( '' . $size . 'px', $style[$session_type_as_id]['organization']['font_size'] ) . '>' . $size . 'px</option>';
    }
    $html .= '</select>
						</td>
					</tr>

					<tr>
						<td>
							' . __( 'Organization Font Color', 'agandapress' ) . '
						</td>
						<td>
							<input type="color" name="gt[style][' . $session_type_as_id . '][organization][font_color]" value="' . $style[$session_type_as_id]['organization']['font_color'] . '">
						</td>
					</tr>

					<tr>
						<td>
							' . __( 'Organization Font Aligenment', 'agandapress' ) . '
						</td>
						<td>
							<div class="squer-radio">
								<input ' . $this->check_rc_value( 'left', $style[$session_type_as_id]['organization']['font_aligenment'] ) . ' type="radio" value="left" name="gt[style][' . $session_type_as_id . '][organization][font_aligenment]" id="gt[style][' . $session_type_as_id . '][organization][font_aligenment][left]">
								<label for="gt[style][' . $session_type_as_id . '][organization][font_aligenment][left]"><svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="align-left" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="svg-inline--fa fa-align-left fa-w-14 fa-3x"><path fill="currentColor" d="M288 44v40c0 8.837-7.163 16-16 16H16c-8.837 0-16-7.163-16-16V44c0-8.837 7.163-16 16-16h256c8.837 0 16 7.163 16 16zM0 172v40c0 8.837 7.163 16 16 16h416c8.837 0 16-7.163 16-16v-40c0-8.837-7.163-16-16-16H16c-8.837 0-16 7.163-16 16zm16 312h416c8.837 0 16-7.163 16-16v-40c0-8.837-7.163-16-16-16H16c-8.837 0-16 7.163-16 16v40c0 8.837 7.163 16 16 16zm256-200H16c-8.837 0-16 7.163-16 16v40c0 8.837 7.163 16 16 16h256c8.837 0 16-7.163 16-16v-40c0-8.837-7.163-16-16-16z" class=""></path></svg></label>
								<input ' . $this->check_rc_value( 'center', $style[$session_type_as_id]['organization']['font_aligenment'] ) . ' type="radio" value="center" name="gt[style][' . $session_type_as_id . '][organization][font_aligenment]" id="gt[style][' . $session_type_as_id . '][organization][font_aligenment][center]">
								<label for="gt[style][' . $session_type_as_id . '][organization][font_aligenment][center]"><svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="align-center" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="svg-inline--fa fa-align-center fa-w-14 fa-3x"><path fill="currentColor" d="M352 44v40c0 8.837-7.163 16-16 16H112c-8.837 0-16-7.163-16-16V44c0-8.837 7.163-16 16-16h224c8.837 0 16 7.163 16 16zM16 228h416c8.837 0 16-7.163 16-16v-40c0-8.837-7.163-16-16-16H16c-8.837 0-16 7.163-16 16v40c0 8.837 7.163 16 16 16zm0 256h416c8.837 0 16-7.163 16-16v-40c0-8.837-7.163-16-16-16H16c-8.837 0-16 7.163-16 16v40c0 8.837 7.163 16 16 16zm320-200H112c-8.837 0-16 7.163-16 16v40c0 8.837 7.163 16 16 16h224c8.837 0 16-7.163 16-16v-40c0-8.837-7.163-16-16-16z" class=""></path></svg></label>
								<input ' . $this->check_rc_value( 'right', $style[$session_type_as_id]['organization']['font_aligenment'] ) . ' type="radio" value="right" name="gt[style][' . $session_type_as_id . '][organization][font_aligenment]" id="gt[style][' . $session_type_as_id . '][organization][font_aligenment][right]">
								<label for="gt[style][' . $session_type_as_id . '][organization][font_aligenment][right]"><svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="align-right" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="svg-inline--fa fa-align-right fa-w-14 fa-3x"><path fill="currentColor" d="M160 84V44c0-8.837 7.163-16 16-16h256c8.837 0 16 7.163 16 16v40c0 8.837-7.163 16-16 16H176c-8.837 0-16-7.163-16-16zM16 228h416c8.837 0 16-7.163 16-16v-40c0-8.837-7.163-16-16-16H16c-8.837 0-16 7.163-16 16v40c0 8.837 7.163 16 16 16zm0 256h416c8.837 0 16-7.163 16-16v-40c0-8.837-7.163-16-16-16H16c-8.837 0-16 7.163-16 16v40c0 8.837 7.163 16 16 16zm160-128h256c8.837 0 16-7.163 16-16v-40c0-8.837-7.163-16-16-16H176c-8.837 0-16 7.163-16 16v40c0 8.837 7.163 16 16 16z" class=""></path></svg></label>
							</div>
						</td>
					</tr>
					<tr>
						<td>
							' . __( 'Organization Font Style', 'agandapress' ) . '
						</td>
						<td>
							<div class="squer-radio">
								<input ' . $this->check_rc_value( 'bold', $style[$session_type_as_id]['organization']['font_style']['bold'] ) . ' type="checkbox" value="bold" name="gt[style][' . $session_type_as_id . '][organization][font_style][bold]" id="gt[style][' . $session_type_as_id . '][organization][font_style][bold]">
								<label for="gt[style][' . $session_type_as_id . '][organization][font_style][bold]"><svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="bold" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" class="svg-inline--fa fa-bold fa-w-12 fa-3x"><path fill="currentColor" d="M304.793 243.891c33.639-18.537 53.657-54.16 53.657-95.693 0-48.236-26.25-87.626-68.626-104.179C265.138 34.01 240.849 32 209.661 32H24c-8.837 0-16 7.163-16 16v33.049c0 8.837 7.163 16 16 16h33.113v318.53H24c-8.837 0-16 7.163-16 16V464c0 8.837 7.163 16 16 16h195.69c24.203 0 44.834-1.289 66.866-7.584C337.52 457.193 376 410.647 376 350.014c0-52.168-26.573-91.684-71.207-106.123zM142.217 100.809h67.444c16.294 0 27.536 2.019 37.525 6.717 15.828 8.479 24.906 26.502 24.906 49.446 0 35.029-20.32 56.79-53.029 56.79h-76.846V100.809zm112.642 305.475c-10.14 4.056-22.677 4.907-31.409 4.907h-81.233V281.943h84.367c39.645 0 63.057 25.38 63.057 63.057.001 28.425-13.66 52.483-34.782 61.284z" class=""></path></svg></label>
								<input ' . $this->check_rc_value( 'italic', $style[$session_type_as_id]['organization']['font_style']['italic'] ) . ' type="checkbox" value="italic" name="gt[style][' . $session_type_as_id . '][organization][font_style][italic]" id="gt[style][' . $session_type_as_id . '][organization][font_style][italic]">
								<label for="gt[style][' . $session_type_as_id . '][organization][font_style][italic]"><svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="italic" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" class="svg-inline--fa fa-italic fa-w-10 fa-3x"><path fill="currentColor" d="M204.758 416h-33.849l62.092-320h40.725a16 16 0 0 0 15.704-12.937l6.242-32C297.599 41.184 290.034 32 279.968 32H120.235a16 16 0 0 0-15.704 12.937l-6.242 32C96.362 86.816 103.927 96 113.993 96h33.846l-62.09 320H46.278a16 16 0 0 0-15.704 12.935l-6.245 32C22.402 470.815 29.967 480 40.034 480h158.479a16 16 0 0 0 15.704-12.935l6.245-32c1.927-9.88-5.638-19.065-15.704-19.065z" class=""></path></svg></label>
								<input ' . $this->check_rc_value( 'underline', $style[$session_type_as_id]['organization']['font_style']['underline'] ) . ' type="checkbox" value="underline" name="gt[style][' . $session_type_as_id . '][organization][font_style][underline]" id="gt[style][' . $session_type_as_id . '][organization][font_style][underline]">
								<label for="gt[style][' . $session_type_as_id . '][organization][font_style][underline]"><svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="underline" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="svg-inline--fa fa-underline fa-w-14 fa-3x"><path fill="currentColor" d="M224.264 388.24c-91.669 0-156.603-51.165-156.603-151.392V64H39.37c-8.837 0-16-7.163-16-16V16c0-8.837 7.163-16 16-16h137.39c8.837 0 16 7.163 16 16v32c0 8.837-7.163 16-16 16h-28.813v172.848c0 53.699 28.314 79.444 76.317 79.444 46.966 0 75.796-25.434 75.796-79.965V64h-28.291c-8.837 0-16-7.163-16-16V16c0-8.837 7.163-16 16-16h136.868c8.837 0 16 7.163 16 16v32c0 8.837-7.163 16-16 16h-28.291v172.848c0 99.405-64.881 151.392-156.082 151.392zM16 448h416c8.837 0 16 7.163 16 16v32c0 8.837-7.163 16-16 16H16c-8.837 0-16-7.163-16-16v-32c0-8.837 7.163-16 16-16z" class=""></path></svg></label>
							</div>
						</td>
					</tr>
					<tr>
						<td>
							' . __( 'Organization Profile Link', 'agandapress' ) . '
						</td>
						<td>
							<input type="checkbox" name="gt[style][' . $session_type_as_id . '][organization][profile_link]" ' . $this->check_rc_value( 'on', $style[$session_type_as_id]['organization']['profile_link'] ) . '>
						</td>
					</tr>
				</table>';
    $html .= '</div>';
    $html .= '</div>';
    $html .= '</div>';
    $html .= '</div>';
    $html .= '</div>';
    $html .= '</div>';
}
$html .= '</div>';
echo  $html ;