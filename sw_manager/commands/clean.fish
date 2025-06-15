#!/usr/bin/env fish
# commands/clean.fish
# ------------------
# Empties all subdirectories of ./p2-yii2/*/runtime/*

# Loop through each runtime sub-folder
for runtime_dir in ./p2-yii2/*/runtime/*
    if test -d $runtime_dir
        echo "Cleaning: $runtime_dir"
        # Remove everything inside it
        rm -rf -- $runtime_dir/*
    end
end

echo "✅ All runtime directories cleaned."
