<?php
declare(strict_types=1);

namespace Jonre\Mariteslog;
use Illuminate\Support\Facades\Log;

class Mariteslog
{
  protected $logName = 'laravel';

  public function __construct(string $logName)
  {
    $this->logName = $logName;
  }

  public static function insert($channel = null, string $level, string $message, array $array = [])
  {
    return Log::channel($channel)->{$level}($message, $array);
  }

  public function toArray()
  {
    $logFilePath = storage_path('logs') . DIRECTORY_SEPARATOR . $this->logName . ".log";
    if (!file_exists($logFilePath)) throw new \Exception(__("Log name `{$this->logName}` not found"));
    $logContents = file_get_contents($logFilePath);
    
    $logContents = file_get_contents($logFilePath);
    $pattern = '/\[\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}([\+-]\d{4})?\].*/';
    $currentLogPattern = '/^\[(.*?)\]\s(.*?)\:\s(.*)$/';
    $logEntries = [];

    if (preg_match_all($pattern, $logContents, $matches, PREG_SET_ORDER)) {
      foreach ($matches as $match) {
       if(preg_match($currentLogPattern, current($match), $matchesCurrent)) {
        $date = $matchesCurrent[1];
        $level = $matchesCurrent[2];
        $message = $matchesCurrent[3];
        $logEntry = [
            'date' => $date,
            'level' => $level,
            'message' => $message,
        ];

        $logEntries[] = $logEntry;

       }
        
      }
    }
    return $logEntries;
  }
}