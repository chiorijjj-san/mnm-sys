<?php
// Define the repository URL and the target directory for deployment
$repositoryUrl = 'https://github.com/yourusername/yourrepository.git';
$targetDir = '/path/to/your/target/directory';
$branch = 'main'; // Specify the branch you want to deploy

// Function to execute shell commands
function executeCommand($command) {
    $output = [];
    $returnVar = null;
    exec($command, $output, $returnVar);
    return ['output' => $output, 'return_var' => $returnVar];
}

// Step 1: Pull the latest changes if the target directory exists
if (is_dir($targetDir)) {
    // Navigate to the target directory and pull the latest changes
    $pullCommand = "cd $targetDir && git pull origin $branch";
    $result = executeCommand($pullCommand);
    if ($result['return_var'] !== 0) {
        die("Failed to pull latest changes: " . implode("\n", $result['output']));
    }
    echo "Latest changes pulled successfully.\n";
    echo "List of changes:\n";
    echo implode("\n", $result['output']);
} else {
    die("Target directory does not exist. Please clone the repository first.\n");
}

// Step 2: (Optional) Run additional commands for deployment
// For example, you might want to run composer install or npm install
// $additionalCommand = "cd $targetDir && composer install";
// $result = executeCommand($additionalCommand);
// if ($result['return_var'] !== 0) {
//     die("Failed to run additional command: " . implode("\n", $result['output']));
// }
// echo "Additional command executed successfully.\n";

echo "Deployment completed successfully.\n";
?>
