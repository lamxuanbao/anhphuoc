<?php


namespace Kizi\Core\Document\Services;


class LogService
{
    private $file;
    private $folder;
    private $storage_path;
    const MAX_FILE_SIZE = 52428800;
    private $level;
    private $pattern;

    public function __construct()
    {
        $this->level = new LevelService();
        $this->pattern = new PatternService();
        $this->storage_path = storage_path('logs');

    }

    public function setFolder($folder)
    {
        if (app('files')->exists($folder)) {
            $this->folder = $folder;
        }
        if (is_array($this->storage_path)) {
            foreach ($this->storage_path as $value) {
                $logsPath = $value.'/'.$folder;
                if (app('files')->exists($logsPath)) {
                    $this->folder = $folder;
                    break;
                }
            }
        } else {
            if ($this->storage_path) {
                $logsPath = $this->storage_path.'/'.$folder;
                if (app('files')->exists($logsPath)) {
                    $this->folder = $folder;
                }
            }
        }
    }

    public function setFile($file)
    {
        $file = $this->pathToLogFile($file);

        if (app('files')->exists($file)) {
            $this->file = $file;
        }
    }

    public function pathToLogFile($file)
    {

        if (app('files')->exists($file)) { // try the absolute path
            return $file;
        }
        if (is_array($this->storage_path)) {
            foreach ($this->storage_path as $folder) {
                if (app('files')->exists($folder.'/'.$file)) { // try the absolute path
                    $file = $folder.'/'.$file;
                    break;
                }
            }
            return $file;
        }

        $logsPath = $this->storage_path;
        $logsPath .= ($this->folder) ? '/'.$this->folder : '';
        $file = $logsPath.'/'.$file;
        // check if requested file is really in the logs directory
        if (dirname($file) !== $logsPath) {
            throw new \Exception('No such log file');
        }
        return $file;
    }

    public function getFolderName()
    {
        return $this->folder;
    }

    public function getFileName()
    {
        return basename($this->file);
    }

    public function all()
    {
        $log = array();

        if (!$this->file) {
            $log_file = (!$this->folder) ? $this->getFiles() : $this->getFolderFiles();
            if (!count($log_file)) {
                return [];
            }
            $this->file = $log_file[0];
        }

        $max_file_size = '52428800';
        if (app('files')->size($this->file) > $max_file_size) {
            return null;
        }

        if (!is_readable($this->file)) {
            return [
                [
                    'context' => '',
                    'level' => '',
                    'date' => null,
                    'text' => 'Log file "'.$this->file.'" not readable',
                    'stack' => '',
                ]
            ];
        }

        $file = app('files')->get($this->file);

        preg_match_all($this->pattern->getPattern('logs'), $file, $headings);

        if (!is_array($headings)) {
            return $log;
        }

        $log_data = preg_split($this->pattern->getPattern('logs'), $file);

        if ($log_data[0] < 1) {
            array_shift($log_data);
        }

        foreach ($headings as $h) {
            for ($i = 0, $j = count($h); $i < $j; $i++) {
                foreach ($this->level->all() as $level) {
                    if (strpos(strtolower($h[$i]), '.'.$level) || strpos(strtolower($h[$i]), $level.':')) {

                        preg_match($this->pattern->getPattern('current_log',
                                0).$level.$this->pattern->getPattern('current_log', 1), $h[$i], $current);
                        if (!isset($current[4])) {
                            continue;
                        }

                        $log[] = array(
                            'context' => $current[3],
                            'level' => $level,
                            'folder' => $this->folder,
                            'level_class' => $this->level->cssClass($level),
                            'level_img' => $this->level->img($level),
                            'date' => $current[1],
                            'text' => $current[4],
                            'in_file' => isset($current[5]) ? $current[5] : null,
                            'stack' => preg_replace("/^\n*/", '', $log_data[$i])
                        );
                    }
                }
            }
        }

        if (empty($log)) {

            $lines = explode(PHP_EOL, $file);
            $log = [];

            foreach ($lines as $key => $line) {
                $log[] = [
                    'context' => '',
                    'level' => '',
                    'folder' => '',
                    'level_class' => '',
                    'level_img' => '',
                    'date' => $key + 1,
                    'text' => $line,
                    'in_file' => null,
                    'stack' => '',
                ];
            }
        }

        return array_reverse($log);
    }

    public function getFolders()
    {
        $folders = glob($this->storage_path.'/*', GLOB_ONLYDIR);
        if (is_array($this->storage_path)) {
            foreach ($this->storage_path as $value) {
                $folders = array_merge(
                    $folders,
                    glob($value.'/*', GLOB_ONLYDIR)
                );
            }
        }

        if (is_array($folders)) {
            foreach ($folders as $k => $folder) {
                $folders[$k] = basename($folder);
            }
        }
        return array_values($folders);
    }

    public function getFolderFiles($basename = false)
    {
        return $this->getFiles($basename, $this->folder);
    }

    public function getFiles($basename = false, $folder = '')
    {
        $pattern = '*.log';
        $files = glob(
            $this->storage_path.'/'.$folder.'/'.$pattern,
            preg_match($this->pattern->getPattern('files'), $pattern) ? GLOB_BRACE : 0
        );
        if (is_array($this->storage_path)) {
            foreach ($this->storage_path as $value) {
                $files = array_merge(
                    $files,
                    glob(
                        $value.'/'.$folder.'/'.$pattern,
                        preg_match($this->pattern->getPattern('files'), $pattern) ? GLOB_BRACE : 0
                    )
                );
            }
        }

        $files = array_reverse($files);
        $files = array_filter($files, 'is_file');
        if ($basename && is_array($files)) {
            foreach ($files as $k => $file) {
                $files[$k] = basename($file);
            }
        }
        return array_values($files);
    }
}
