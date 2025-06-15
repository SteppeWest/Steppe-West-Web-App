#!/usr/bin/env fish
# sw_manager/main.fish

# 1. Resolve the script path (follow the symlink)
set script (status --current-filename)
if test -L $script
    # readlink gives the target, relative if you created the symlink that way
    set target (readlink $script)
    # if it’s still relative, turn it into an absolute path
    if not string match -r '^/' $target
        set target (realpath $script:h/$target)
    end
    set script_dir (dirname $target)
else
    set script_dir (dirname $script)
end

# 2. Pick up the sub‐command (default to “help”)
if test (count $argv) -gt 0
    set cmd (printf '%s' $argv[1] | tr '[:upper:]' '[:lower:]')
    set args $argv[2..-1]
else
    set cmd help
    set args
end

# 3. Dispatch
switch $cmd
    case help -h --help
        source $script_dir/commands/help.fish $args

    case clean
        source $script_dir/commands/clean.fish $args

    case backup
        source $script_dir/commands/backup.fish $args

    case compose
        source $script_dir/commands/compose.fish $args

    case deploy
        source $script_dir/commands/deploy.fish $args

    # …other commands…

    case '*'
        echo "Unknown command ‘$cmd’. Try ‘sw help’."
        exit 1
end
