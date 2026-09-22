<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_ffmpeg {
	
	public function generate($filesListArr, $musicPath, $volumeArr, $outputFilePath) {
		$action = 'multiple';
		if (count($filesListArr) == 1) {  //add music only
			$action = 'music';
		}
		elseif ($musicPath == '0') { //concat only
			$action = 'concat';
		}
		try {
			if ($action == 'music') {  //one voice file and the background music only
				$voiceFilesFinal = $this->volume($filesListArr[0], $volumeArr[0]);
				$musicFilesFinal = $this->volume($musicPath, $volumeArr[1]);
				$this->mix($musicFilesFinal, $voiceFilesFinal, $outputFilePath);
				if ($voiceFilesFinal != $filesListArr[0]) {
					unlink($voiceFilesFinal);
				}
				if ($musicFilesFinal != $musicPath) {
					unlink($musicFilesFinal);
				}
				$result = true;
			}
			elseif ($action == 'concat') {  //multiple voice files, no background music
				$this->concat($filesListArr, $outputFilePath);
				if ($volumeArr[0] != '1.0') {  //volume of the output file needs to be adjusted
					$outputFilePathFinal = $this->volume($outputFilePath, $volumeArr[0]);
					unlink($outputFilePath);
					rename($outputFilePathFinal, $outputFilePath);
				}
				$result = true;
			}
			else { //multiple voice files and background music
				$tmpOutputFilePath = FCPATH . 'tts_file/user/' . 'tmp_' . my_random() . '.mp3';
				$this->concat($filesListArr, $tmpOutputFilePath);
				$voiceFilesFinal = $this->volume($tmpOutputFilePath, $volumeArr[0]);
				$musicFilesFinal = $this->volume($musicPath, $volumeArr[1]);
				$this->mix($musicFilesFinal, $voiceFilesFinal, $outputFilePath);
				if ($voiceFilesFinal != $tmpOutputFilePath) {
					unlink($voiceFilesFinal);
				}
				if ($musicFilesFinal != $musicPath) {
					unlink($musicFilesFinal);
				}
				unlink($tmpOutputFilePath);
				$result = true;
			}
		}
		catch (Exception $e) {
			$result = false;
		}
		return $result;
	}
	
	
	
	public function volume($filePath, $level) {
		if ($level == '1.0') {  //compare using string
			$returnedFilePath = $filePath;
		}
		else {
			try {
				$returnedFilePath = FCPATH . 'tts_file/user/' . 'tmp_volume_' . my_random() . '.mp3';
				shell_exec($this->ffmpegPath() . ' -i ' . $filePath . ' -filter:a "volume=' . doubleval($level) . '" ' . $returnedFilePath);
			}
			catch (Exception $e) {
				$returnedFilePath = $filePath;
			}
		}
		return $returnedFilePath;
	}
	
	
	
	//one by one
	public function concat($inputFilesArray, $outputFile) {
		try {
			shell_exec($this->ffmpegPath() . ' -i "concat:' . implode('|', $inputFilesArray) . '" -acodec copy ' . $outputFile);
		}
		catch (Exception $e) {
			//logged
		}
		return TRUE;
	}
	
	
	
	//mix two, $baseFile(background music) will be looped if necessary
	public function mix($baseFile, $extendedFile, $outputFile) {
		try {
			shell_exec($this->ffmpegPath() . ' -stream_loop -1 -i ' . $baseFile . ' -i ' . $extendedFile . ' -filter_complex "[0:a][1:a]amerge=inputs=2[a]" -map "[a]" ' . $outputFile);
		}
		catch (Exception $e) {
			//logged
		}
	}
	
	
	
	//get voice file duration
	public function getDuration($filePath) {
		try {
			$duration = trim(shell_exec($this->ffmpegPath('ffprobe') . ' -v error -show_entries format=duration -of default=noprint_wrappers=1:nokey=1 ' . $filePath));
			($duration == 'N/A') ? $result = FALSE : $result = $duration;
		}
		catch (Exception $e) {
			$result = FALSE;
			//logged
		}
		return $result;
	}
	
	
	
	
	protected function ffmpegPath($appName = 'ffmpeg') {
		if (!empty(shell_exec("which ffmpeg"))) {
			$result = 'ffmpeg';
		}
		elseif (strtoupper(substr(PHP_OS, 0, 3)) == 'WIN') {
			$result = $appName;
		}
		else {
			$result = FCPATH . 'vendor/ffmpeg/' . $appName;
		}
		return $result;
	}
	
	
	
}
?>