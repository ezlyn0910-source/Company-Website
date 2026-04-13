<?php
// admin/includes/admin-header.php
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title ?? 'Admin - NR Intellitech'; ?></title>
    <style>
        /* Add your admin styles here */
        .admin-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        
        .admin-actions {
            margin-bottom: 20px;
        }
        
        .btn {
            padding: 8px 16px;
            text-decoration: none;
            border-radius: 4px;
            margin-right: 10px;
        }
        
        .btn-primary {
            background: #007bff;
            color: white;
        }
        
        .btn-edit {
            background: #28a745;
            color: white;
        }
        
        .btn-delete {
            background: #dc3545;
            color: white;
        }
        
        .news-table {
            width: 100%;
            border-collapse: collapse;
        }
        
        .news-table th, .news-table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        
        .news-table th {
            background: #f8f9fa;
            font-weight: bold;
        }
        
        .status-badge {
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 12px;
        }
        
        .status-badge.published {
            background: #d4edda;
            color: #155724;
        }
        
        .status-badge.draft {
            background: #fff3cd;
            color: #856404;
        }
    </style>
</head>
<body>